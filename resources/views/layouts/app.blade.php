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
    <!-- Google Fonts: DotGothic16 -->
    <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm mb-0">
            <div class="container">
                @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <h1 class="h5 mb-0">{{ config('app.name') }}</h1>
                    </a>
                @endguest
                @auth
                    @if ( auth()->user()->role_id === 1 || auth()->user()->role_id === 2)
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <h1 class="h5 mb-0">{{ config('app.name') }}</h1>
                        </a>
                    @else <!-- adminの遷移先が違うなら、要修正。変わらないなら削除。 -->
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <h1 class="h5 mb-0">{{ config('app.name') }}</h1>
                        </a>
                    @endif
                @endauth
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    {{-- Search bar here. Show it only to the login user. --}}
                    <ul class="navbar-nav mx-auto">
                        <form action="{{ route('quest.search') }}" method="GET" class="position-relative" style="width: 300px;">
                            <input type="search" name="search" class="form-control form-control-sm ps-4" placeholder="Search..." aria-label="Search">
                            <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-2 text-secondary"></i>
                        </form>
                    </ul>
                   
                    <ul class="navbar-nav me-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/news') }}">News</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  d-flex align-items-center" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </a>
                            <!-- category ドロップダウンメニュー -->
                            <ul class="dropdown-menu dropdown-menu-end nav-item-dropdown" aria-labelledby="categoryDropdown">
                                @php
                                    // データベースからカテゴリーデータを取得
                                    $categories = DB::table('categories')->get();
                                @endphp
                                @foreach ($categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('quest.search', ['category' => $category->id]) }}"><img src="{{ asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/FAQ-Contact') }}">FAQ/Contact</a>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <!-- ログインしていない場合に表示 -->
                            <li class="nav-item">
                                <a class="custom-btn" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="custom-btn" href="{{ route('register') }}">{{ __('Registration') }}</a>
                            </li>
                            @endif
                        @endguest
                        @auth
                            @if ( auth()->user()->role_id === 1)
                                <!-- ログインしている場合に表示 -->
                                <li class="nav-item-2 dropdown">
                                    <a href="#" class="nav-link d-flex align-items-center" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="rounded-circle icon">
                                            {{-- avatar/icon --}}
                                            @if( Auth::user()->image )
                                                {{-- <img src="{{ asset(Auth::user()->image) }}" alt="" class="rounded-circle img-icon"> --}}
                                                <img src="{{ asset(Auth::user()->image) }}" alt="" class="rounded-circle img-icon">
                                            @else
                                                <i class="fas fa-user"></i>
                                            @endif
                                        </div>
                                    </a>
                                    <!-- ドロップダウンメニュー -->
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <div class="d-flex align-items-center p-3">
                                            <div class="rounded-circle icon">
                                                {{-- avatar/icon --}}
                                                @if( Auth::user()->image )
                                                    <img src="{{ asset(Auth::user()->image) }}" alt="" class="rounded-circle img-icon">
                                                @else
                                                    <i class="fas fa-user"></i>
                                                @endif
                                            </div>
                                            <div class="ms-3">
                                                <li class="mb-0 fw-bold">{{  Auth::user()->first_name }} {{ Auth::user()->family_name }}</li>
                                                <li class="mb-0 text-muted">{{ Auth::user()->email }}</li>
                                            </div>
                                        </div>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{ route('player.mypage', Auth::user()->id) }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">My Page</a></li>
                                        {{-- <li><a class="dropdown-item" href="#"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Go to Quest Creator page</a></li>
                                        <li><hr class="dropdown-divider"></li> --}}
                                        <li><a class="dropdown-item" href="{{ route('quest.status', Auth::user()->id) }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Quest Status</a></li>
                                        <li><a class="dropdown-item" href="{{ route('player.studyplan', Auth::user()->id) }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Study Plan</a></li>
                                        <li><a class="dropdown-item" href="{{ route('favorites.index') }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Favorite Quest Creator</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{route('account.security', Auth::user()->id)}}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Account Setting</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                        <img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Logout
                                            </a>
                                            <!-- ログアウト用フォーム -->
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @elseif ( auth()->user()->role_id === 2)
                                <!-- ログインしている場合に表示 -->
                                <li class="nav-item-2 dropdown">
                                    <a href="#" class="nav-link d-flex align-items-center" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="rounded-circle icon">
                                            {{-- avatar/icon --}}
                                            @if(Auth::user()->questCreators->creator_image)
                                                <img src="{{ Auth::user()->questCreators->creator_image }}" alt="" class="rounded-circle img-icon">
                                            @else
                                                <i class="fas fa-user"></i>
                                            @endif
                                        </div>
                                    </a>
                                    <!-- ドロップダウンメニュー -->
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <div class="d-flex align-items-center p-3">
                                            <div>
                                                {{-- avatar/icon --}}
                                                @if(Auth::user()->questCreators->creator_image)
                                                    <img src="{{ Auth::user()->questCreators->creator_image }}" alt="" class="rounded-circle img-icon">
                                                @else
                                                    <i class="fas fa-user"></i>
                                                @endif
                                            </div>
                                            <div class="ms-3">
                                                <li class="mb-0 fw-bold">{{  Auth::user()->questCreators->creator_name }}</li>
                                                <li class="mb-0 text-muted">{{ Auth::user()->email }}</li>
                                            </div>
                                        </div>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{route('questcreators.creatorMyPage', Auth::user()->id)}}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword'" class="sword">My Page and Dashbord</a></li>
                                        <li><a class="dropdown-item" href="{{ route('player.mypage', Auth::user()->id) }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword'" class="sword">Go to Mypage as Player</a></li>
                                        
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{ route('questcreators.how-to-guide') }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">How-to Guide</a></li>
                                        <li><a class="dropdown-item" href="{{ route('quests.index') }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword'" class="sword">Quest List</a></li>
                                        <li><a class="dropdown-item" href="#"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword'" class="sword">Quest Data Overview</a></li>

                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{ route('quest.status', Auth::user()->id) }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Quest Status</a></li>
                                        <li><a class="dropdown-item" href="{{ route('player.studyplan', Auth::user()->id) }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword'" class="sword">Study Plan</a></li>
                                        <li><a class="dropdown-item" href="{{ route('favorites.index') }}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword'" class="sword">Favorite Quest Creator</a></li>

                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{ route('questcreators.profile.view', ['id' => Auth::id()])}}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">My Profile as Creator</a></li>
                                        <li><a class="dropdown-item" href="{{route('questcreators.profile.edit', Auth::user()->id)}}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Edit My Creater Profile</a></li>

                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{route('account.security', Auth::user()->id)}}"><img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Account Settitng</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                        <img src="{{asset('images/Sword Icon 02.png') }}" alt="sword" class="sword">Logout
                                            </a>
                                            <!-- ログアウト用フォーム -->
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                            @endif

                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <main class="@yield('main-class', 'py-0')">
            <div class="container">
                <div class="row justify-content-center">
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="text-white py-4" style="margin: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h5>EduQuest</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home')}}" class="text-white text-decoration-none">Home</a></li>
                            <li><a href="/news" class="text-white text-decoration-none">News</a></li>
                            <li><a href="FAQ-Contact" class="text-white text-decoration-none">FAQ/Contact</a></li>
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
    @yield('scripts')
</body>
</html>