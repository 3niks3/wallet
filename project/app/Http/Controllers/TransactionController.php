<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function list()
    {
        dd('list');
    }

    public function create()
    {
        dd('create');
    }

    public function createAction()
    {
        dd('createAction');
    }

    public function markAsFraudAction()
    {
        dd('markAsFraudAction');
    }

    public function deleteAction()
    {
        dd('deleteAction');
    }
}
