<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function registration()
    {
        return view('registration');
    }

    public function logout()
    {
        dd('logout');
    }

    public function registrationAction()
    {
        $validator = \Validator::make(request()->all(), [
            'name' => 'required|min:1|max:255',
            'surname' => 'nullable|min:1|max:255',
            'email' => 'required|email|min:3|max:255|unique:users,email',
            'password' => 'required|min:6|max:32|',
            'password_again' => 'required_with:password|same:password',
        ]);

        if($validator->fails()) {
            return response()->json(['status' => false, 'messages' => $validator->messages()->getMessages()]);
        }

        dd('register and log in ');




        dd($validator->messages()->getMessages());
        dd('registrationAction');
    }

    public function loginAction()
    {
        dd('loginAction');
    }
}
