@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body text-justify">
        <div class="row">
            <fieldset class="col-sm-6 col-sm-offset-3">
                <legend class="text-center">Información detallada</legend>
                @if (isset($doc))
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Nombre del archivo:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $doc->filename }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Descripción:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $doc->description }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Tipo:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $doc->type }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Propietario</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $user != null ?$user->name:'Desconocido' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Fecha subida:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $doc->created_at }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Última modificación:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $doc->updated_at }}</p>
                        </div>
                    </div>
                    @if($doc->addit_info != null)
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Información adicional:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $doc->addit_info }}</p>
                        </div>
                    </div>
                    @endif
                @else
                <p>Ha habido un error</p>
                @endif
            </fieldset>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-8">
                    <div class="col-xs-6 col-sm-4 {{ isset($doc)?'':'col-sm-offset-4 col-xs-offset-6' }}">
                        <a class="btn btn-default pull-right" href="{{ url()->previous() }}">Volver</a>
                    </div>
                     @if (isset($doc))
                    <div class="col-xs-6 col-sm-4">
                        <a class="btn btn-primary pull-right" href="{{ url('/docs/download', $doc->id) }}"><strong>Descargar</strong></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
