@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body text-justify">
        <div class="row">
            <fieldset class="col-sm-12">
                <legend class="text-center">Listado de archivos compartidos y/o gestionados por ti</legend>
                    <table id="myDocsTable" class="table table-bordered">
                        <thead>
                            <th class="col-sm-1">ID</th>
                            <th class="col-sm-2">Nombre</th>
                            <th class="col-sm-3">Descripción</th>
                            <th class="col-sm-2">Tipo</th>
                            <th style="display:none">Tags</th>
                            <th class="col-sm-4">Acciones</th>
                        </thead>
                    </table>
            </fieldset>
        </div>
    </div>
</div>

<!--Para recuperar mediante jQuery el id del usuario logueado-->
{{ Form::hidden('userAuth', Auth::id(), array('id' => 'userAuth')) }}

@endsection
