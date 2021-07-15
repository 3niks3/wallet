<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\UserValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function registrationAction()
    {
        $validation = new UserValidationService(request()->all());
        $validationResults = $validation->validate();

        if(!$validationResults['status']) {
            return response()->json($validationResults);
        }

        $user = new User;
        $user->name = trim(request()->name);
        $user->surname = trim(request()->surname);
        $user->email = trim(request()->email);
        $user->password = Hash::make(request()->password);
        $user->save();

        Auth::login($user);

        return response()->json(['status' => true, 'messages' => []]);
    }

    public function loginAction()
    {
        $credentials = request()->only('email', 'password');

        if(Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return redirect()->route('wallet');
        }

        return redirect()->route('login')->withErrors(['Incorrect authentication credentials!']);
    }
}
