<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Wallet</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <!-- Font-awesomeCSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="/css/app.css" rel="stylesheet">

        @stack('style')


    </head>
    <body>

    <div class="container-fluid g-0">

        <header>
            <div class="row g-0">
                <div class="col">
                    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark p-2">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <i class="fas fa-wallet"></i> My Wallet
                        </a>

                        @if(auth()->check())
                        <div class="ms-auto navbar-brand">
                            <i class="fas fa-users me-2"></i>
                            {{auth()->user()->name}}
                            <a href="{{ route('logout') }}" class="btn btn-outline-success ms-2">logout</a>
                        </div>
                        @else
                            <div class="ms-auto">
                                <a href="{{ route('login') }}" class="btn btn-primary">Sign in</a>
                                <a href="{{ route('registration') }}" class="btn btn-outline-success">Register</a>
                            </div>
                        @endif
                    </nav>
                </div>
            </div>
        </header>
    </div>

    <div class="container-fluid w-100">
        <!-- Main Page-->
        <main>
            <div class="container-fluid w-100 ps-3 pe-3">
                @yield('content')
            </div>
        </main>


    </div>

        @stack('footer')
        @stack('modals')




    <script src="/js/app.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->

    <!--  Custom CDN scripts -->
    @stack('before_scripts')

    @stack('scripts')

    @foreach (Alert::getMessages() as $type => $messages)
        @foreach ($messages as $message)
            <script>
                console.log(Noty)
                new Noty({
                    type: "{{$type}}",
                    text: '{{$message}}',
                }).show();
            </script>
        @endforeach
    @endforeach

    </body>
</html>
