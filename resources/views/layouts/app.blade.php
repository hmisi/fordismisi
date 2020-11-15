<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('desc')">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="https://64.media.tumblr.com/bc95cfa5ab29b1bbf6474456aae24e28/7040187b7d4ccdc2-45/s1280x1920/1e9d6d15abb248c74a07153064990d34735bf8a5.png" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="container">
    <div id="app">
        <div>
            <nav class="navbar mt-5">
                <a class="navbar-brand text-dark" href="{{url('/')}}"><b>AyoAsk!</b></a>
                <div class="form-inline">
                    <!-- Right Side Of Navbar -->
                        <!-- Authentication Links -->
                        @guest
                                <a class="badge badge-primary p-2 mr-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                    <a class="badge badge-warning p-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <div class="dropdown">
                                <b>Hi!</b> <a id="navbarDropdown" class="text-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                </div>
            </div>
        </nav>

            <main class="content">
                @yield('content')
            </main>
        <div class="text-center my-5">
            <p>&copy; Copyright AyoAsk! {{date('Y')}}<br>Dibuat dengan [ 🖤 ] dari Developer untuk Developers</p>
        </div>
    </div>
</body>
</html>