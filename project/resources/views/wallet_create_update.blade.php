@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="card mt-5 text-center offset-md-3 col-12 col-md-6">
            <div class="card-body">
                <h1 class="card-title">Create Wallet</h1>
                <form action="{{ $formUrl }}" method="post" id="walletCreateUpdateForm">

                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="floatingInput" placeholder="My Wallet" value="{{ $wallet->name ?? '' }}">
                        <label for="floatingInput">Name</label>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="action" value="{{ $button['value'] }}">
                            <div class="invalid-feedback"></div>
                            <button type="sumbit"  class="btn btn-primary float-start">{{ $button['name'] }}</button>

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
        $('form#walletCreateUpdateForm').submit(function(e){
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
                        window.location.replace('{{ route('wallet') }}');
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
