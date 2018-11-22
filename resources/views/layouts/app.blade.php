<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
   
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="user_id" content="{!! Auth::check()?Auth::id():null !!}"/>
    @yield('meta')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{  asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .nav-item {
            padding: 0 13px 0 5px;
        }
        .blog-item{
            margin-bottom: 10px;
            background-color: #fdfdfd;
            border-bottom: 1px solid #dddddd;
            padding: 20px;
        }
    </style>
    @yield('styles')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('site.chat') !!}">{{ __('Chat My Friends') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {!! __('Blogs') !!}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{!! route('site.blog-list') !!}" class="nav-link">List All
                                    </a>

                                    <a href="{!! route('site.blog-create') !!}" class="nav-link">
                                        Add new
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('site.my-blog') !!}">{{ __('My Blogs') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="">{{ __('Profile') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
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
@yield('scripts')
</html>
