@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="card mt-5 text-center offset-md-3 col-12 col-md-6">
            <div class="card-body">
                <h1 class="card-title">Sign in</h1>
                <form action="{{ route('loginAction') }}" method="post">

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" class="btn btn-primary float-start" value="Sign in">
                            <a href="{{ route('registration') }}" class="btn btn-outline-success float-end">Register</a>
                        </div>
                    </div>
                    {{ csrf_field() }}

                    @if($errors->any())
                        <div class="row mt-3">
                            <div class="col">
                                <ul class="list-group">
                                    @foreach($errors->all() as $error)
                                        <li class="list-group-item list-group-item-danger">{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif


                </form>
            </div>
        </div>
    </div>
@endsection
