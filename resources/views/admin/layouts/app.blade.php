<?php
/**
 * This Software is the property of Lucart Group and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * @copyright (C) Lucart Group
 * @author Lucart Group
 */
?>
<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

@include('common.hiddenCredits')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Mobile Internet Explorer ClearType Technology -->
    <!--[if IEMobile]>  <meta http-equiv="cleartype" content="on">  <![endif]-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="{{ config('app.theme_color', '#ffffff') }}">

    <title>@yield('title_prefix') @yield('title', config('app.name')) @yield('title_postfix')</title>

    <meta name="locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>
    <meta name="base_url" content="{{ url('/') }}">
    <meta name="generator" content="Laravel {{ App::VERSION() }}">
    <link rel="canonical" href="@yield('canonical', request()->url())" />
    {{-- <link rel="canonical" href="@yield('canonical', url()->current())"> --}}

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- Styles -->
    @yield('cssTopStart')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}" type="text/css">

    {{-- Plugins --}}
    <link rel="stylesheet" href="{{ asset('/plugins/toastr/build/toastr.min.css') }}" type="text/css">

    @yield('cssTopMiddle')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/css/adminlte.min.css') }}" type="text/css">

    @yield('cssTopEnd')

    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <!--AfterStyles -->
    @stack('afterStylesheets')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- Here we have global JS configurations --}}
    @include('common.globals')

    @php
        $isLoginArea = (isset($isLoginPage) && $isLoginPage === true) ? true : false;
    @endphp
</head>
<body class="hold-transition sidebar-mini @yield('body_class', str_replace('.', '-', optional(Route::current())->getName())) {{ $isLoginArea ? 'login-page' : '' }}">
    @include('common.demo')
    @include('common.impersonate')
    <!--[if lt IE 7]>
        <p class="chromeframe">
            You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.
        </p>
    <![endif]-->
    @if ($isLoginArea)
    <main class="{{ $loginClass ?? 'login-box' }}" id="app">
        <div class="login-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('/img/general/logo-big.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="img-fluid" />
                {{-- {{ config('app.name', 'Laravel') }} --}}
            </a>
        </div>
        @yield('content')
    </main>
    @else
    <div class="wrapper" id="app">
        @include('admin.layouts.includes.navbar')

        @include('admin.layouts.includes.aside')

        <!-- Content Wrapper. Contains page content -->
        <main class="content-wrapper">

            @include('admin.layouts.includes.content_header')

            <!-- Main content -->
            <div class="content container-fluid">

                @yield('content')

            </div>
        </main>

        {{-- @include('admin.layouts.includes.sidebar') --}}
        {{-- @include('admin.layouts.includes.footer') --}}
    </div>
    @endif

    @yield('scriptBottomStart')

    <!-- jQuery -->
    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Plugins --}}
    <script src="{{ asset('/plugins/toastr/build/toastr.min.js') }}"></script>

    @yield('scriptBottomMiddle')

    <!-- AdminLTE App -->
    <script src="{{ asset('/js/adminlte.min.js') }}"></script>

    @yield('scriptBottomEnd')

    <!-- Custom Scripts -->
    <script src="{{ asset('/js/custom.js') }}"></script>

    {{-- Global toastr --}}
    @include('common.toastr')

    <!-- After Scripts - mainly used to stack js comming from partials-->
    @stack('afterJsScripts')
</body>
</html>
