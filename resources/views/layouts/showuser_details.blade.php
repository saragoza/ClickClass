@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body text-justify">
       @include('layouts.show_message')
        <div class="row">
            <fieldset class="col-sm-6 col-sm-offset-3">
                <legend class="text-center">Información detallada</legend>
                @if (isset($user))
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>ID usuario:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $user->id }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Nombre:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Email:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Fecha alta:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $user->created_at }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Última modificación:</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <p>{{ $user->updated_at }}</p>
                        </div>
                    </div>
                @else
                <p>Ha habido un error</p>
                @endif
            </fieldset>
            <div class="row">
                <div class="col-sm-3 col-sm-offset-8">
                     @if(isset($user))
                    <button class="btn btn-default" data-toggle="modal" data-target="#modal">Borrar perfil</button>
                    <a class="btn btn-primary pull-right col-sm-5" href="{{ url('user/edit') }}"><strong>Editar</strong></a>
                    @endif
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel"><strong>Eliminar perfil de usuario</strong></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h4>¿Está seguro de que desea eliminar su perfil de usuario?</h4>
                        <p>Esta acción no se podrá deshacer, y conllevará la pérdida de la propiedad de todos sus archivos compartidos</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <a type="button" class="btn btn-primary" href="{{ url('user/delete') }}"><strong>Eliminar</strong></a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
