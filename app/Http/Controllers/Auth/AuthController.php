<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = $this->validateLogin($credentials);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Data tidak terdaftar!',
        ]);
    }

    protected function validateLogin(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/dashboard');
    }

    
    public function showChangePasswordForm()
    {
        return view('Auth.updatepassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        /** @var \App\Models\User $user **/
        if (Hash::check($request->current_password, $user->getAuthPassword())) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Password berhasil diubah!');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Password yang dimasukkan salah!']);
        }
    }
}


