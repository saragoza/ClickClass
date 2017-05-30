@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body text-justify">
       @include('layouts.show_message')
        <div class="row">
            <fieldset class="col-sm-12">
                <legend class="text-center">Accede a los archivos compartidos por otros miembros de la comunidad ClickClass</legend>
                    <table id="docsTable" class="table table-bordered">
                        <thead>
                            <th class="col-sm-1">ID</th>
                            <th class="col-sm-2">Nombre</th>
                            <th class="col-sm-3">Descripción</th>
                            <th class="col-sm-2">Tipo</th>
                            <th style="display:none">Tags</th>
                            <th class="col-sm-2">Acciones</th>
                        </thead>
                    </table>
            </fieldset>
        </div>
    </div>
</div>

@endsection
