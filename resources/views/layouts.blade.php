<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Apna Basket') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/like.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}

    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mcss.css') }}" rel="stylesheet">
    <link href="{{ asset('css/like.css') }}" rel="stylesheet">
    <link href="{{ asset('css/payment.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <h5 class="my-0 mr-md-auto font-weight-normal">Apna Basket</h5>
               
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

               
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        {{--@if (Route::has('home'))
                        <button class="btn btn-secondary" type="button" aria-expanded="false">
                            <a class="p-2 text-dark text-decoration-none font-weight-light" href="{{ route('home') }}">Dashboard</a>
                        </button>
                        @endif--}}

                        {{-- <div class="container"> --}}
                            @include('search.search')
                        {{-- </div> --}}
                        <div class="dropdown">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Shop By Category
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/category/Fruits & vagetable">Fruits & vagetable</a></li>
                                <li><a class="dropdown-item" href="/category/Bakery Cakes & Diary">Bakery Cakes & Diary</a></li>
                                <li><a class="dropdown-item" href="/category/Snacks & Branded Foods">Snacks & Branded Foods</a></li>
                                <li><a class="dropdown-item" href="/category/Cleaning & House Holds">Cleaning & House Holds</a></li>
                                <li><a class="dropdown-item" href="/category/Baby Care">Baby Care</a></li>
                                <li><a class="dropdown-item" href="/category/Beauty & Hygiene">Beauty & Hygiene</a></li>
                                <li><a class="dropdown-item" href="/category/Oil & Masala">Oil & Masala</a></li>

                            </ul>
                        </div>

                        <div class="container">
                            <a href="/mcart" class="btn btn-outline-dark">
                                <i class="bi-cart-fill me-1"></i>
                                Cart
                                {{-- <span class="badge bg-dark text-white ms-1 rounded-pill">0</span> --}}
                            </a>
                        </div>

                        <div class="container">
                            <a href="{{ route('items.index') }}" class="btn btn-outline-dark">
                                Items
                            </a>
                        </div>
                    <form method="get" action=" {{ route('filter') }}" enctype="multipart/form-data">
                        <div class="contaner d-flex">   
                            <select class="form-select" aria-label="Default select example" name="filter">
                                <option value="LH">Price Low To High</option>
                                <option value="HL">Price High To Low</option>
                                <option>Popularity</option>
                            </select>
                        
                            
                            <button type="submit" class="btn btn-outline-dark">Filter</button>
                        </div>
                    </form>
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname}}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">My Account</a>
                                <a class="dropdown-item" href="/myOrders">My Orders</a>
                                <a class="dropdown-item" href="/mcart">My Cart</a>
                                <a class="dropdown-item" href="#">My Rewards</a>
                                <a class="dropdown-item" href="/MyLikes">My Likes Items</a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
    </div>
</body>

</html>