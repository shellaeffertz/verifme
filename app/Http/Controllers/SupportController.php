<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Services\NotificationService;

class SupportController extends Controller
{
    public function indexAdmin(Request $request)
    {
        $support_messages = SupportTicket::join('users', 'users.id', '=', 'support_tickets.user_id')->select('support_tickets.*', 'users.username', 'users.email')->orderBy('id', 'desc')->where('status', '!=', 'completed')->paginate(10);
        return view('support.admin-index', ['support_messages' => $support_messages]);
    }

    public function indexClient(Request $request)
    {
        $support_messages = SupportTicket::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('support.client-index', ['support_messages' => $support_messages]);
    }

    public function showAdmin(Request $request, $id)
    {
        $support = SupportTicket::find($id);
        if(!$support)  return redirect()->route('support.index')->with('error', 'Support ticket not found.');
        $messages = Message::where('source_id', $support->id)->where('source_type', 'support_ticket')->orderBy('id', 'desc')->paginate(10);
        return view('support.admin-show', ['support' => $support, 'messages' => $messages, 'order' => $support->type == 'report' ? Order::where('uuid', $support->order_uuid)->first() : null]);
    }

    public function showClient(Request $request, $id)
    {
        $user = auth()->user();
        $support = SupportTicket::where('user_id', $user->id)->find($id);
        if(!$support)  return redirect()->route('support.client.index')->with('error', 'Support ticket not found.');
        return view('support.client-show', ['support' => $support]);
    }

    public function create(Request $request)
    {

        $order = $request->order;
        $user = auth()->user();

        if($order && Order::where('buyer_id', $user->id)->where('uuid', $order)->exists()) {
            return view('support.report', ['order' => Order::where('buyer_id', $user->id)->where('uuid', $order)->first()]);
        }

        return view('support.create');
    }

    public function storeReport(Request $request)
    {
        
        $data = $request->validate([
            'order' => 'required|exists:orders,uuid',
            'subject' => 'required|max:255',
            'message' => 'required|max:1000',
        ]);

        $order = Order::where('uuid', $data['order'])->first();

        if(!$order|| $order->buyer_id != auth()->user()->id) {
            return redirect()->route('support.index')->with('error', 'You don\'t have permission to report this order.');
        }

        $support = new SupportTicket();
        $support->user_id = auth()->user()->id;
        $support->subject = $data['subject'];
        $support->message = $data['message'];
        $support->order_uuid = $order->uuid;
        $support->type = 'report';
        $support->save();

        NotificationService::addNotification(null, 'report_created', 'Report is opened', 'A Report is opened', '/admin/support/' . $support->id);
        return redirect()->route('support.client.index')->with('success', 'Support ticket created successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required|max:1000',
        ]);

        $support = new SupportTicket();
        $support->user_id = auth()->user()->id;
        $support->subject = $request->subject;
        $support->message = $request->message;
        $support->save();

        NotificationService::addNotification(null, 'ticket_created', 'Ticket is opened', 'A Ticket is opened', '/admin/support/' . $support->id);
        return redirect()->route('support.client.index')->with('success', 'Support ticket created successfully.');
    }

    public function supportReplay(Request $request, $id)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $support = SupportTicket::find($id);
        if(!$support) {
            return redirect()->route('support.index')->with('error', 'Support ticket not found.');
        }

        if ($support->status == 'completed') {
            return redirect()->route('support.index')->with('error', 'Support ticket is already completed. please create a new one.');
        }

        $message = new Message();
        $message->source_id = $support->id;
        $message->source_type = 'support_ticket';
        $message->sender_id = auth()->user()->id;
        $message->sender_type = 'support';
        $message->message = $request->message;
        $message->save();

        return redirect()->route('support.index')->with('success', 'Support ticket created successfully.');
    }

    public function userReplay(Request $request, $id)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $user = auth()->user();
        $support = SupportTicket::where('user_id', $user->id)->find($id);
        if(!$support)  return redirect()->route('support.client.index')->with('error', 'Support ticket not found.');
        if ($support->status == 'completed') return redirect()->route('support.client.index')->with('error', 'Support ticket is already completed. please create a new one.');
        
        $message = new Message();
        $message->source_id = $support->id;
        $message->source_type = 'support_ticket';
        $message->sender_id = $user->id;
        $message->sender_type = 'user';
        $message->message = $request->message;
        $message->save();

        return view('support.client-show', ['support' => $support, 'messages' => $support->messages]);
    }

    public function markAsCompleted(Request $request, $id)
    {
        $support = SupportTicket::find($id);
        $support->status = 'completed';
        $support->save();

        return redirect()->route('admin.support.index')->with('success', 'Support ticket marked as completed.');
    }

}
