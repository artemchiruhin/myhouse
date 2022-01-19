<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect(route('index'));
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validatedFields = $request->validate(['login' => 'required','password' => 'required']);
        if(Auth::attempt($validatedFields)) {
            if(Auth::user()->role === 'user') {
                return redirect(route('index'));
            } else if(Auth::user()->role === 'admin') {
                return redirect(route('admin.index'));
            }
        }
        return back()->withErrors(['incorrect_user' => 'Пользователь не найден.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('index'));
    }
}
