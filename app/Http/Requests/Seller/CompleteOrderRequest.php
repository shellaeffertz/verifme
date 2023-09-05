<?php

namespace App\Http\Requests\Seller;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class CompleteOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        $uuid = $this->route('uuid');
        $order = Order::where('seller_id', $user->id)->where('uuid', $uuid)->where('status', 'pending')->first();
        if (!$order) return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $products = config('products');
        return $products[$this->type]['private'];
    }
}
