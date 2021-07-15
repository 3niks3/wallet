@extends('layout.layout')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 col-md-6">
            <h1 class="card-title mt-3 ">My Wallets</h1>
        </div>
        <div class="col-12 col-md-6">
            <a href="{{ route('walletCreate') }}" class="btn btn-outline-success btn-lg float-md-end mt-2">
                <i class="fas fa-plus"></i>
                Create new Wallet
            </a>
        </div>
    </div>
    <div class="row">

        <div class="card mt-3 col">
            <div class="card-body">

                @if($wallets->isEmpty())
                    <div class="col text-center">
                        <h3 class="mb-4">You dont have any Wallets</h3>
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-md-3 g-4">

                    @foreach($wallets as $wallet)

                        <div class="col">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <a href="#" class="link-primary">
                                        <h5 class="card-title"> {{ $wallet->name }} </h5>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><strong>Wallet balance: </strong> {{ $wallet->amount }}</p>
                                </div>
                                <div class="card-footer text-muted">
                                    <a href="{{ route('walletUpdate', $wallet->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('walletDeleteAction',  $wallet->id) }}" class="btn btn-danger float-end delete-wallet">Delete</a>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('a.delete-wallet').click(function(e){
            if(!confirm('Are You sure you want to delete wallet')) {
                return false;
            }
        })
    </script>
@endpush
