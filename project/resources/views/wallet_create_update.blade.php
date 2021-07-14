@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="card mt-5 text-center offset-md-3 col-12 col-md-6">
            <div class="card-body">
                <h1 class="card-title">Create Wallet</h1>
                <form action="{{ route('walletCreateAction') }}" method="post">

                    <div class="form-floating mb-3">
                        <input type="text" name="ma,e" class="form-control" id="floatingInput" placeholder="My Wallet">
                        <label for="floatingInput">Name</label>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" class="btn btn-primary float-start" value="Create">
                            <a href="{{ route('wallet') }}" class="btn btn-outline-secondary float-end">Back</a>
                        </div>
                    </div>

                    {{ csrf_field() }}

                </form>
            </div>
        </div>
    </div>
@endsection
