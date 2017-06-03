@extends('layouts.app')

@section('content')
<div style="position:absolute;top:50%;transform:translate(-0%, -50%);-webkit-transform: translate(-0%, -50%)" class="row">
    <div style="z-index:1" class="col-md-6 col-lg-4 col-lg-offset-2">
       <br>
       <div style="font-size:5em;opacity:0" id="p-inicio-1"><p><strong>SHARE</strong></p></div>
       <div style="font-size:5em;opacity:0" id="p-inicio-2"><p><strong>SEARCH</strong></p></div>
       <div style="font-size:9em;opacity:0" id="p-inicio-3"><p><strong>ENJOY!</strong></p></div>
    </div>
    <div style="z-index:0" id="marco-inicio-1" class="img-content col-md-6 col-lg-6">
        <img class="img-responsive pull-right" src="img/logotipoXL.jpg" alt="Logotipo animado">
    </div>
</div>
@endsection
