<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/course.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/76674689d1.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-md-0 px-xl-0 px-lg-5">
            <a class="navbar-brand" href="#!"><img class="logo img-responsive" src="{{config('app.presta_url')}}/img/logo-1637616049.jpg" alt="ITCM" loading="lazy" width="260"></a>
            <div class="d-md-block text-right" style="float: right; text-align: right;">
                <span>Ucz się wygodnie i skutecznie z ITCM DAO</span>
            </div>
        </div>
    </nav>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark">
        <div class="container px-5">
{{--            <a class="navbar-brand" href="#!">Start Bootstrap</a>--}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('user.course.index')}}">Moje kursy</a></li>

                </ul>
            </div>
            <div id="_desktop_user_info">
                <div class="user-info">
                    @guest
                        @if (Route::has('login'))
                            <a class="account" href="{{ route('login') }}" title="Wyświetl moje konto klienta" rel="nofollow">
                                <i class="fas fa-user"></i>
                                <span class="hidden-sm-down">Zaloguj się</span>
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a class="account" href="{{config('app.presta_url').'/logowanie?create_account=1'}}" title="Wyświetl moje konto klienta" rel="nofollow">
                                <span class="hidden-sm-down">Zarejestruj się</span>
                            </a>
                        @endif
                    @else
{{--                        <a class="account" href="http://sklep.dwomxteamy.cfolks.pl/moje-konto" title="Wyświetl moje konto klienta" rel="nofollow">--}}
                            <i class="fas fa-user"></i>
                            <span class="hidden-sm-down">{{auth()->user()->firstname ?? ''}} {{auth()->user()->lastname ?? ''}}</span>
{{--                        </a>--}}
                        <a class="account" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Wyloguj
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest


                </div>
            </div>
        </div>
    </nav>
    <div id="app">

        <div class="container px-4 px-lg-5">
            @yield('content')

        </div>

        <main class="py-4">
        </main>
    </div>
</body>
</html>
