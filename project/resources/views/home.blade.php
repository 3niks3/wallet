@extends('layout.layout')

@section('content')
    <div class="card mt-5 text-center">
        <div class="card-body">
            <h1 class="card-title">Welcome to My Wallet</h1>
            <p class="card-text">Pay or deposit your money in virtual wallets!</p>

            @if(auth()->check())
                <a href="{{ route('wallet') }}" class="btn btn-primary">Check my Wallets</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Sign in</a>
                <a href="{{ route('registration') }}" class="btn btn-outline-success">Register</a>
            @endif

        </div>
    </div>
@endsection
