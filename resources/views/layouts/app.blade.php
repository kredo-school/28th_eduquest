<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Custom CSS / Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Fontawesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    {{-- 以下、字体を変更用。 --}}
    <!-- Google Fonts: DotGothic16 -->
    <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1 class="h5 mb-0">{{ config('app.name') }}</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- Search bar here. Show it only to the login user. --}}
                    

                    <ul class="navbar-nav ms-auto">
                        <form action="#" method="GET" class="position-relative" style="width: 300px;">
                            <input type="search" name="search" class="form-control form-control-sm ps-4" placeholder="Search..." aria-label="Search">
                            <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-2 text-secondary"></i>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">FAQ/Contact</a>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- 常にアイコンを表示 -->
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link d-flex align-items-center" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div style="width: 40px; height: 40px; background-color: #007BFF; color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </a>
                                <!-- ドロップダウンメニュー -->
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="#">プロフィール</a></li>
                                    <li><a class="dropdown-item" href="#">設定</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">ログアウト</a></li>
                                </ul>
                            </li>
                        </ul>

                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="custom-btn" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="custom-btn" href="{{ route('register') }}">{{ __('Registration') }}</a>
                        </li>
                        @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="text-white py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h5>EduQuest</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                            <li><a href="#" class="text-white text-decoration-none">News</a></li>
                            <li><a href="#" class="text-white text-decoration-none">FAQ/Contact</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Terms and conditions</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Privacy Policy</a></li>
                        </ul>
                    </div>
        
                    <div class="col-md-4 mb-3 ms-auto">
                        <h5>Company</h5>
                    </div>
                </div>
        
            </div>
        </footer>
    
    </div>

    
</body>





</html>
