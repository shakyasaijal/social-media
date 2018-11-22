<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{!! config()->get('app.name') !!} | @yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->

    <link href="{!! asset('assets/plugins/bootstrap/css/bootstrap.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/plugins/multi-select/css/multi-select.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') !!}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{!! asset('assets/plugins/node-waves/waves.css') !!}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{!! asset('assets/plugins/animate-css/animate.css') !!}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{!! asset('assets/plugins/morrisjs/morris.css') !!}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{!! asset('assets/css/style.css') !!}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{!! asset('assets/css/themes/all-themes.css') !!}" rel="stylesheet" />
</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<div class="overlay"></div>

<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>

<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{!! route('admin.dashboard') !!}">{!! config('app.name') !!}</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
            </ul>
        </div>
    </div>
</nav>