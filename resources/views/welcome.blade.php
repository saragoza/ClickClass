<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ClickClass</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/clickclass.css" rel="stylesheet" media="screen">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ url('/login') }}">Conectarse</a>
                        <a href="{{ url('/register') }}">Registrarse</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="img-content">
                            <img class="img-responsive" src="img/logotipoXL.jpg" alt="Logotipo ClickClass">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
