@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body text-justify">
        @include('layouts.show_message')
        <form id="shareForm" class="form-horizontal" role="form" method="POST" action="{{ isset($doc)?url('/docs/update', $doc->id):url('/docs/store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="row">
                <fieldset class="col-sm-10 col-sm-offset-1">
                    <legend class="text-center">{{ isset($doc)?'Editar archivo':'Comparte tus archivos con el resto de la comunidad ClickClass' }}</legend>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="description">Descripción:</label>
                                <span>(*)</span>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ isset($doc) ? $doc->description : '' }}" autofocus>
                                @if($errors->has('description'))
                                    <span style="color:red;"><small>{{ $errors->first('description') }}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="searchtags">Tags de búsqueda:</label>
                            </div>
                            <div class="col-sm-9">
                                <input id="addBorder" type="text" class="form-control bootstrap-tagsinput" id="searchtags" name="searchtags" data-role="tagsinput" value="{{ isset($doc) ? $doc->tags : '' }}"/>
                            </div>
                            @if($errors->has('searchtags'))
                                <span style="color:red;"><small>{{ $errors->first('searchtags') }}</small></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="filetype">Tipo de archivo:</label>
                                <span>(*)</span>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-control" id="file_type" name="file_type">
                                    @if (isset($doc))
                                        <option selected>{{ $doc->type }}</option>
                                    @else
                                        <option disabled selected value> -- Selecciona el tipo de archivo -- </option>
                                    @endif
                                    @if (isset($types))
                                        @foreach ($types as $t)
                                            <option id="{{ $t->type }}" name="{{ $t->type }}">{{ $t->type }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('file_type'))
                                    <span style="color:red;"><small>{{ $errors->first('file_type') }}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="sharedfile">Ruta del archivo:</label>
                                @if(!isset($doc))
                                <span>(*)</span>
                                @endif
                            </div>
                            <div class="col-sm-9">
                                <input type="file" id="sharedfile" name="sharedfile" class="form-control">
                                @if ($errors->has('sharedfile'))
                                    <span style="color:red;"><small>{{ $errors->first('sharedfile') }}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="additinfo">Información adicional:</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="additinfo" name="additinfo">
                                    {{ isset($doc) ? $doc->addit_info : '' }}
                                </textarea>
                                @if ($errors->has('additinfo'))
                                    <span style="color:red;"><small>{{ $errors->first('additinfo') }}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <span><small class="col-sm-offset-3">* Campos obligatorios</small></span>
                </fieldset>
            </div>
            <div class="row">
                <div clas="col-sm-10 col-sm-offset-1">
                    @if (isset($doc))
                    <div class="col-xs-6 col-sm-1 col-sm-offset-9">
                        <a class="btn btn-default pull-right" href="{{ url('/docs/mydocs') }}">Volver</a>
                    </div>
                    @endif
                    <div class="col-xs-6 col-sm-1 {{ isset($doc)?'':'col-sm-offset-10' }}">
                        <button id="submitShareForm" type="button" class="btn btn-primary pull-right"><strong>Enviar</strong></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
