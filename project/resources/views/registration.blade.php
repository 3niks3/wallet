@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="card mt-5 text-center offset-md-3 col-12 col-md-6">
            <div class="card-body">
                <h1 class="card-title mb-3">Registration</h1>

                <form action="{{ route('registrationAction') }}" method="post" id="registrationForm">

                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="John">
                                <label for="name">Name</label>
                                <div class="invalid-feedback" data-input-field="#name"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="surname" class="form-control" id="surname" placeholder="Doe">
                                <label for="surname">Surname</label>
                                <div class="invalid-feedback" data-input-field="#surname"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                <label for="password">Password</label>
                                <div class="invalid-feedback" data-input-field="#password"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password_again" class="form-control" id="password_again" placeholder="Password again">
                                <label for="password_again-input">Password again</label>
                                <div class="invalid-feedback" data-input-field="password_again"></div>
                            </div>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary float-start" value="Register">
                    <a href="{{ route('login') }}" class="btn btn-outline-success float-end">Sign in</a>
                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
@endsection


