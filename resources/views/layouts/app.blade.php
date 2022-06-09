<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('/fonts/css/all.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/sweetalert.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sriracha&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ribeye&display=swap" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">

            <div class="container">

                <div class="container">
                <a class="navbar-brand" href="https://orion3.com.br">
                    <img src="{{asset('images/logo-orion3.png')}}" width="50px" alt="Logo Orion 3">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav"></ul>

                    <!-- Authentication Links -->
                    @if (Auth::check())
                    {{-- The user is logged in... --}}
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav mr-auto">

                        <!-- <a class="navbar-brand" href="{{ url('https://orion3.com.br/') }}">
                        <img style="display:inline;margin:0 auto; margin-left:5px; background-color: white" src="{{asset('images/logo-orion3.png')}}" alt="" width="50px">
                        </a> -->
                        
                        <li class="nav-item menu_posts">
                            <a class="nav-link" href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item menu_posts">
                            <a class="nav-link" href="{{route('urls.index')}}">URL's</a>
                        </li>
						
                        @if((auth()->user()->email == "robertopinheiro7843@gmail.com") || (auth()->user()->email == "administrador@gmail.com"))

                        <li class="nav-item menu_users">
                            <a class="nav-link" href="{{route('users.index')}}">Users</a>
                        </li>

                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav mr-auto">
                    <!-- Left Side Of Navbar -->

                        <!-- <a class="navbar-brand" href="{{ url('https://orion3.com.br/') }}">
                        <img style="display:inline;margin:0 auto; margin-left:5px; background-color: white" src="{{asset('images/logo-orion3.png')}}" alt="" width="50px">
                        </a> -->

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                    </ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                    </ul>
                    @endif

                    </ul>
                </div>
            </div>
        </nav>

        <main style="margin:65px 40px" class="py-4">
            @yield('content')
        </main>

        <div class="fixed-bottom text-white bg-dark text-center p-3 mt-1" role="alert">
            <a style="color: yellow" href="https://orion3.com.br" target="_blank">Orion 3</a> - By: Roberto Pinheiro -
            Copyright
            &copy; <?php echo date('Y'); ?> - Todos os direitos reservados.
        </div>

    </div>
  
    <script src="{{ asset('/js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/fonts/js/all.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>

</body>

</html>
