@extends('layout.layout')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 col-md-6">
            <h1 class="card-title mt-3 ">
                <a href="{{ route('wallet') }}" class="link-dark">Wallet "{{ $wallet->name }}"</a>
            </h1>
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
                <table class="table table-bordered text-center">
                    <thead class="">
                    <tr>
                        <th scope="col">Total Balance</th>
                        <th scope="col">Total incoming</th>
                        <th scope="col">Total Outgoing</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ Format::formatMoneyNumber($wallet->total_balance_amount) }}</td>
                        <td>{{ Format::formatMoneyNumber($wallet->total_incoming_amount) }}</td>
                        <td class="font-weight-bold">{{ Format::formatMoneyNumber($wallet->total_outgoing_amount) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="card mt-3 col">
            <div class="card-body">

                <div class="col">
                    <h3 class="mb-4">Transactions</h3>
                </div>

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

                            @if($transactions->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">Wallet do not have any transaction</td>
                                </tr>
                            @endif

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

                                        <a href="{{ route('transactionFraud', [$wallet->id, $transaction->id]) }}" class="btn btn-warning">{{ ( $transaction->fraud == 1)?'Remove from fraud':'Add to fraud' }}</a>

                                        @if($lastTransaction->id ==  $transaction->id)
                                            <a href="{{ route('transactionDelete', [$wallet->id, $transaction->id]) }}" class="btn btn-danger delete-transaction">Delete</a>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row ">
                    <div class="col">
                        {!! $transactions->links() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('a.delete-transaction').click(function(e){
            if(!confirm('Are You sure you want to delete Transaction')) {
                return false;
            }
        })
    </script>
@endpush
