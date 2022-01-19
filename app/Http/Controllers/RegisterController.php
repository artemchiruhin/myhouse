<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect('/');
        }
        return view('auth.registration');
    }

    public function save(Request $request)
    {
        if(Auth::check()) {
            return redirect('/');
        }

        $validatedFields = $request->validate([
            'login' => 'required|min:5|max:30|regex:/^[a-z-]+$/i|unique:users',
            'password' => 'required|confirmed|min:5|max:30',
            'password_confirmation' => 'required|min:5|max:30',
            'email' => 'required|email|max:100',
            'full_name' => 'required|min:10|max:255|regex:/[А-Яа-яЁё]/u',
            'checkbox' => 'accepted'
        ]);

        $user = User::create($validatedFields);
        if($user) {
            Auth::login($user);
            return redirect('/');
        }

        return redirect(route('registration'))->withErrors([
            'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }
}
