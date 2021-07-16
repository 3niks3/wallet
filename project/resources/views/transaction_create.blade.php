@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="card mt-5 text-center offset-md-3 col-12 col-md-6">
            <div class="card-body">
                <h1 class="card-title">Create Transaction</h1>
                <form action="{{ route('transactionCreateAction', $wallet->id) }}" method="post" id="transactionCreate">

                    <div class="row mt-3">
                        <div class="col text-start">
                            <figcaption class="blockquote-footer">
                                Maximum transfer amount {{ Format::formatMoneyNumber(App\Service\TransactionValidationService::MAX_TRANSFER_AMOUNT) }}
                            </figcaption>
                            <figcaption class="blockquote-footer">
                                Maximum Outgoing amount {{ Format::formatMoneyNumber($wallet->max_available_outgoing_amount) }}
                            </figcaption>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-auto">
                            <label>Transaction type</label>
                            <select class="form-select" name="type" aria-label="Transaction type">
                                <option>-</option>
                                <option value="in">Incoming</option>
                                <option value="out">Outgoing</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col">
                            <label for="floatingInput">Name</label>
                            <input type="number" name="amount" class="form-control" id="floatingInput" placeholder="Amount" step="0.01">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="sumbit"  class="btn btn-primary float-start">Create transaction</button>

                            <a href="{{ route('wallet') }}" class="btn btn-outline-secondary float-end">Back</a>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <ul class="list-group form-errors"></ul>
                        </div>
                    </div>

                    {{ csrf_field() }}

                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('form#transactionCreate').submit(function(e){
            e.preventDefault();

            //clean last errors
            $(this).find('ul.form-errors').html('')

            //get form parameters
            let form = $(this)
            let target = $(this).attr('action');
            let form_data = new FormData(this);

            //send post
            axios.post(target, form_data)
                .then(function (response) {

                    let status = response.data.status || false;
                    let messages = response.data.messages || {};

                    if (status == true) {
                        window.location.replace('{{ route('transactionList',$wallet->id) }}');
                    }

                    console.log(messages);

                    $.each(messages, function( index, msg ){
                        form.find('ul.form-errors').append('<li class="list-group-item list-group-item-danger">'+msg+'</li>')
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    </script>
@endpush
