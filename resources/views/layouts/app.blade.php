<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ClickClass') }}</title>

        <!-- Styles -->
        <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/css/bootstrap-tagsinput.css" rel="stylesheet" media="screen">
        <link href="{{ URL::asset('/css/responsive.dataTables.min.css') }}"rel="stylesheet" media="screen">
        <link href="/css/clickclass.css" rel="stylesheet" media="screen">
        <script src="{{URL::asset('js/app.js')}}"></script>

        <!-- Scripts -->
        <script>
            window.ClickClass = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
        <div id="app" class="wrap container-fluid">
            <header id="header" class="row">
                <nav class="navbar navbar-default navbar-static-top" role="navigation">
                    <div class="navbar-header col-sm-1">
                        <!-- En pantallas pequeñas, el logotipo y el icono que despliega el menú se agrupan-->
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#app-navbar-collapse">
                            <span class="sr-only">Desplegar menú</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <img class="img-responsive" src="/img/logotipo.jpg" alt="Logotipo ClickClass">
                        </a>
                    </div>

                    <div id="opciones" class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Agrupar los enlaces de navegación que se ocultan al minimizar la barra -->

                        @if (!Auth::guest())
                        <ul id="principal" class="nav navbar-nav col-sm-7">
                            <li class="col-sm-3 text-center"><a id="compartir" href="{{ url('/docs/create') }}">Compartir</a></li>
                            <li class="col-sm-3 text-center"><a id="buscar" href="{{ url('/docs/search') }}">Buscar</a></li>
                            <li class="col-sm-3 text-center"><a id="mis" href="{{ url('/docs/mydocs') }}">Mis Archivos</a></li>
                        </ul>
                        <ul id="otros" class="nav navbar-nav col-sm-2">
                            <li class="text-center">
                                <a id="foro" href="http://clickclass.foroactivo.com/" target="blank"><small>Foro</small></a>
                            </li>
                            <li class="text-center"><a id="ayuda" href="#" target="blank"><small>Ayuda</small></a></li>
                        </ul>
                        <ul id="usuario" class="nav navbar-nav col-sm-2">
                            <li class="dropdown text-center">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/user/profile') }}"><small>Perfil</small></a></li>
                                    <hr>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            <small>Salir</small>
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @else
                        <div class="pull-right col-sm-3">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url('/login') }}">Conectarse</a></li>
                                <li><a href="{{ url('/register') }}">Registrarse</a></li>
                            </ul>
                        </div>
                        @endif

                    </div>
                </nav>
            </header>

            @yield('content')

        </div>

        @if (!Auth::guest())
        <div class="wrap-container-fluid">
            <footer class="footer navbar-static-bottom">
                <div class="row">
                    <div class="col-sm-2 visible-sm visible-md visible-lg pull-right">
                        <a href="http://www.facebook.es"><div class="sprite sprite-facebook"></div></a>
                        <a href="https://twitter.com"><div class="sprite sprite-twitter"></div></a>
                        <a href="https://plus.google.com"><div class="sprite sprite-google"></div></a>
                        <a href="https://www.instagram.com/"><div class="sprite sprite-instagram"></div></a>
                    </div>
                    <div class="texto-pie col-sm-8">
                        <p class="text-muted text-center">
                            <small>Este es un sitio ficticio creado por Sara Santander García para el proyecto de DAW.</small>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
        @endif

        <!--JQuery Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="/js/jquery.dataTables.min.js"></script>
        <script src="/js/dataTables.bootstrap.min.js"></script>
        <script src="/js/jquery-caret.js"></script>
        <script src="/js/clickclass_events.js"></script>
        <script src="/js/bootstrap-tagsinput.min.js"></script>
        <script src="/js/perms.js"></script>
        <script src="/js/mydocs.js"></script>
        <script src="/js/alldocs.js"></script>
    </body>
</html>
