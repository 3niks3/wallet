<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function list()
    {
        return view('wallet_list');
        dd('wallet list');
    }

    public function create()
    {
        return view('wallet_create_update');
        dd('wallet create');
    }

    public function update()
    {
        dd('wallet update');
    }

    public function createAction()
    {
        dd('wallet createAction');
    }

    public function updateAction()
    {
        dd('wallet updateAction');
    }
}
