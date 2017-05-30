@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body text-justify">
        <fieldset class="col-sm-12">
            <legend id="legendPerms" class="legendDoc text-center"></legend>
            <table id="permsTable" class="table table-bordered">
                <thead>
                    <th class="col-sm-2">ID</th>
                    <th class="col-sm-4">Nombre usuario</th>
                    <th class="col-sm-3">Permisos</th>
                    <th class="col-sm-3">Acciones</th>
                </thead>
            </table>
        </fieldset>
        <a id="returnPerms" class="btn btn-default pull-right" href="{{ url()->previous() }}"><strong>Volver</strong></a>
    </div>
</div>

@endsection
