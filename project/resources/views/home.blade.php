@extends('layout.layout')

@section('content')
    <div class="card mt-5 text-center">
        <div class="card-body">
            <h1 class="card-title">Welcome to My Wallet</h1>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Sign in</a>
            <a href="{{ route('registration') }}" class="btn btn-outline-success">Register</a>
        </div>
    </div>
@endsection
