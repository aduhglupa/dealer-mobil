<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    {!! Html::style('plugins/bootstrap/css/bootstrap.min.css') !!}
    @stack('pluginCss')
    {!! Html::style('css/custom.css') !!}
    @stack('css')

    {!! Html::script('plugins/jquery/jquery.min.js') !!}
    {!! Html::script('plugins/bootstrap/js/bootstrap.min.js') !!}
    @stack('pluginJs')
    <script>
        var BASE_URL = '{{ url('/') }}';
    </script>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Dealer Mobil</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Data Mobil <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('mobil') }}">List Mobil</a></li>
                        <li><a href="{{ url('mobil/create') }}">Tambah Mobil</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Data Penjualan <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('penjualan') }}">List Penjualan</a></li>
                        <li><a href="{{ url('penjualan/create') }}">Buat Penjualan</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
@include('partials.alert')
<div class="container">
    @yield('content')
</div>
{!! Html::script('js/main.js') !!}
@stack('js')
</body>
</html>