<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/family.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    @yield('style')

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        @yield('style-text')
    </style>
</head>
<body id="app-layout">
 	@if (!Auth::guest())
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    CRM
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                	<!-- <li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        	Setari <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                        	<li><a href="{{ url('/setari') }}">Aparate</a></li>
                        	<li><a href="{{ url('/setari') }}">Agentie</a></li>
                        	<li><a href="{{ url('/setari') }}">Marca</a></li>
                        	<li><a href="{{ url('/setari') }}">Nr borderou decont</a></li>
                        	<li><a href="{{ url('/setari') }}">Nr borderou insotitor</a></li>
                        	<li><a href="{{ url('/setari') }}">Judet</a></li>
                        	<li><a href="{{ url('/setari') }}">Localitate</a></li>
                        </ul>
                    </li>-->
                    <li><a href="{{ url('/bilete/create') }}">Bilete</a></li>
                    <li><a href="{{ url('/contoare_electronice/create') }}">Contoare electronice</a></li>
                    <li><a href="{{ url('/contoare_mecanice/create') }}">Contoare mecanice</a></li>
                    <li><a href="{{ url('/contacts') }}">Borderou decont</a></li>
                    <li><a href="{{ url('/contacts') }}">Borderou insotitor</a></li>
                    <li><a href="{{ url('/contacts') }}">Rapoarte</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                	<li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        	{{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                        	<li><a href="{{ url('/setari') }}"><i class="fa fa-btn fa-cog"></i>Setari</a></li>
                        	<li role="separator" class="divider"></li>
                        	<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endif

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('JavaScript')
</body>
</html>
