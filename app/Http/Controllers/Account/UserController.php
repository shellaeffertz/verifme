<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Account\LoginRequest;
use App\Http\Requests\Account\UpdateRequest;
use App\Http\Requests\Account\RegisterRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Account\ResetPasswordRequest;
use App\Http\Requests\Account\ForgetPasswordRequest;

class UserController extends Controller
{
    public function registerView(Request $request)
    {
        $user = Auth::user();
        if ($user)  return Redirect::route('home');
        return view('user.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = UserServices::register($request->validated());
        Auth::login($user);
        return Redirect::route('home');
    }

    public function loginView(Request $request)
    {
        $user = Auth::user();
        if ($user)  return Redirect::route('home');
        return view('user.login');
    }

    public function login(LoginRequest $request)
    {
        $user = UserServices::login($request->validated());
        if (!$user) return Redirect::back()->withErrors(['credentiels' => 'Invalid credentials']);
        Auth::login($user);
        return Redirect::route('home');
    }

    public function forgetPasswordView(Request $request)
    {
        $user = Auth::user();
        if ($user)  return Redirect::route('home');
        return view('user.forgot-password');
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $reposnse = UserServices::forgetPassword($request->validated());
        if (!$reposnse) return Redirect::back()->withErrors(['username' => 'Invalid username or email']);
        return Redirect::back()->with('success', 'Check your email to reset your password');
    }

    public function validateResetPasswordToken(Request $request, $token)
    {
        $user = Auth::user();
        if ($user)  return Redirect::route('home');
        $response = UserServices::validateResetPasswordToken($token);
        if (!$response) return Redirect::route('login')->withErrors(['token' => 'Invalid token']);
        return view('user.reset-password', ['token' => $token]);
    }


    public function resetPassword(ResetPasswordRequest $request, $token)
    {
        $user = Auth::user();
        if ($user)  return Redirect::route('home');
        $record = UserServices::validateResetPasswordToken($token);
        if (!$record) return Redirect::route('login')->withErrors(['token' => 'Invalid token']);
        UserServices::resetPassword($request->password, $record->user_id);
        return Redirect::route('login')->with('success', 'Password reset successfully');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        $user_data = UserServices::getProfile($user->id);
        return response()->json($user_data);
    }

    public function update(UpdateRequest $request)
    {
        $user = Auth::user(); 
        $data = $request->validated();
        UserServices::update($user->id, $data);
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function show(Request $request)
    {
        return view('profile', [
            'user' => $request->user()
        ]);
    }

    public function showUsers(Request $request)
    {
        return view('admin.users');
    }

    public function showUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-edit', [
            'user' => $user
        ]);
    }

    public function updateUser(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        $data = $request->validated();

        $user->update($data);
        return redirect('/admin/users/' . $id)->with('success', 'User updated successfully!');
    }
}
