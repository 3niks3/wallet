<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Service\WalletValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class WalletController extends Controller
{
    public function list()
    {
        $wallets = auth()->user()->wallets;
        return view('wallet_list', ['wallets' => $wallets]);
    }

    public function create()
    {
        $formUrl = route('walletCreateAction');
        $wallet = new Wallet();
        $button = ['name' => 'Create', 'value' => 'create'];
        $formTitle = 'Create Wallet';

        return view('wallet_create_update', [
            'formUrl' => $formUrl,
            'wallet' => $wallet,
            'button' => $button,
            'formTitle' => $formTitle
        ]);
    }

    public function update(Wallet $wallet)
    {
        $formUrl = route('walletUpdateAction',$wallet->id);
        $button = ['name' => 'Update', 'value' => 'update'];
        $formTitle = 'Update Wallet';

        return view('wallet_create_update', [
            'formUrl' => $formUrl,
            'wallet' => $wallet,
            'button' => $button,
            'formTitle' => $formTitle
        ]);
    }

    public function createAction()
    {
        $user = auth()->user();

        //validate
        $validation = new WalletValidationService(request()->all(), 'create', $user);
        $validationResults = $validation->validate()->getResponse(true);

        //return errors
        if(!$validationResults['status']) {
            return response()->json($validationResults);
        }

        //store Wallet information
        $wallet = new Wallet();
        $wallet->user_id = $user->id;
        $wallet->name = trim(request()->name);
        $wallet->amount = 0;
        $wallet->save();

        //respond
        \Alert::success('Wallet has been created')->flash();
        return response()->json($validationResults);
    }

    public function updateAction(Wallet $wallet)
    {
        $user = auth()->user();

        //validate
        $validation = new WalletValidationService(request()->all(), 'update', $user, $wallet);
        $validationResults = $validation->validate()->getResponse(true);

        //return errors
        if(!$validationResults['status']) {
            return response()->json($validationResults);
        }

        $wallet->name = trim(request()->name);
        $wallet->save();

        //respond
        \Alert::success('Wallet has been updated')->flash();
        return response()->json($validationResults);
    }

    public function deleteAction(Wallet $wallet)
    {
        $wallet->delete();

        \Alert::success('Wallet has been Deleted')->flash();
        return redirect()->route('wallet');
    }
}
