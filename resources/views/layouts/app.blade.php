<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1725350837862103');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1725350837862103&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    @section('head')



        <!-- Scripts -->
        <link rel="shortcut icon" href="{{ url('new-assets/img/logo.png') }}" type="image/png">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/ideal-postcodes-autocomplete.css') }}" rel="stylesheet">
    @show


</head>

<body>
    <div id="app">
        @if (isset($nobar) && $nobar == 1)
            <div id="loading-image" class="hide">
                <div class="spinner-border text-white" role="status">
                </div>
            </div>
            <div id="loading-image-1" class="">
                <div class="spinner-border page-loader" role="status">
                </div>
            </div>
        @else
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    @guest
                        <a class="navbar-brand" href="{{ url('/') }}">
                        @else
                            <a class="navbar-brand" href="{{ url('/home') }}">
                            @endguest
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ url('settings') }}">
                                                Settings
                                            </a>

                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                </div>
            </nav>
        @endif
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col">
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @yield('content')

            @if (isset($account))
                <!--  <div class="container footer">
                    <div class="row">
                        <div class="col">
                            <img src="'.url('/').'/storage/logo/{!! $account->logo !!}"/>
                        </div>
                        <div class="col text-right">
                            <img src="'.url('/').'/storage/logo/gas-safe.png" class="ml-2"/>
                            <img src="'.url('/').'/storage/logo/ciphe.png" class="ml-2"/>
                        </div>
                    </div>
                </div>-->
            @endif
        </main>
    </div>
    @section('foot')
        <!-- JavaScript Libraries -->
        @if (isset($nobar) && $nobar == 1)
            <script src="{{ asset('js/app.js') }}" defer></script>
        @endif
        <script src="{{ asset('js/ideal-postcodes-autocomplete.min.js') }}" defer></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>
        <script src="{{ url('new-assets/js/jquery-3.5.1.slim.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        {{-- <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script> --}}
        <script src="{{ url('new-assets/slick/slick.min.js') }}"></script>
        <script src="{{ url('new-assets/js/custom.js') }}"></script>
    @show
</body>

</html>
