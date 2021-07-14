@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="card mt-5 text-center offset-md-3 col-12 col-md-6">
            <div class="card-body">
                <h1 class="card-title">Sign in</h1>
                <form action="{{ route('loginAction') }}" method="post">

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <input type="submit" class="btn btn-primary float-start" value="Sign in">
                    <a href="{{ route('registration') }}" class="btn btn-outline-success float-end">Register</a>

                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection
