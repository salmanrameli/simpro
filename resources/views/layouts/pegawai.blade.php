<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a href="{{ route('home') }}">
                    <img src="{{ asset('bootstrap/img/IMG_3521.jpg') }}" style="height: 60px; width: 160px; display: inline-block; padding-right: 20px; padding-top: 5px;" class="pull-left" href="{{ route('home') }}">
                </a>
                {{--<a class="navbar-brand" href="{{ route('home') }}">--}}
                    {{--Home--}}
                {{--</a>--}}
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right navbar-brand-text">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('user.show', Auth::user()->id) }}"><span class="glyphicon glyphicon-user"></span> Lihat Profil</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span class="glyphicon glyphicon-log-out"></span> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="banner-navbar"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissable">
                        @foreach($errors->all() as $error)
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('message') }}
                    </div>
                @endif

                    @if(Session::has('warning'))
                        <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('warning') }}
                        </div>
                    @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-lg-12">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/bootstrap-app.js') }}"></script>
</body>
</html>
