@extends('layout.layout')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 col-md-6">
            <h1 class="card-title mt-3 ">My Wallets</h1>
        </div>
        <div class="col-12 col-md-6">
            <a href="{{ route('transactionCreate', $wallet->id) }}" class="btn btn-outline-success btn-lg float-md-end mt-2">
                <i class="fas fa-plus"></i>
                Create new Transaction
            </a>
        </div>
    </div>
    <div class="row">

        <div class="card mt-3 col">
            <div class="card-body">

                @if($transactions->isEmpty())
                    <div class="col text-center">
                        <h3 class="mb-4">You dont have any Wallets</h3>
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-md-3 g-4">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Fraud</th>
                                <th scope="col">Date</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr class="{{ ($transaction->fraud) ? 'table-warning' : '' }}">
                                <td>{{ $transaction->id }}</td>
                                <td>
                                    <span class="{{ ($transaction->type == 'in') ? 'text-success' : 'text-danger' }}">
                                        <span> {{ ($transaction->type == 'in') ? '+' : '-' }}</span>
                                        <span>{{ $transaction->amount_number_format }}</span>
                                    </span>
                                </td>
                                <td>{{ ($transaction->fraud == 1)?'Yes':'No'  }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td class="text-end" style="width:1%;white-space: nowrap;">
                                    <a href="#" class="btn btn-warning">Mark as fraud</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    @foreach($transactions as $transaction)


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
