 $(document).ready(function(){

        //obtener el id del archivo de la url
        var urlActual = $(location).attr('href');
        var parts = urlActual.split('/');
        var idDoc = parts.pop();

        //cabecera ajax
        $.ajaxPrefilter(function (options, originalOptions, xhr) {
            var token = $('meta[name="csrf-token"]').attr('content');
            if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        });

        //insertar nombre del archivo en la etiqueta <legend>
        $.ajax({
                type: 'post',
                url: '/perms/filename',
                data: {
                    id: idDoc
                },
                success: function (data) {
                    $("#legendPerms").html("Permisos sobre "+data);
                },
                error: function (response) {
                    alert("Error "+data);
                },
                complete: {
                }
            });

        //cargar datos en la datatable
        $(function (){
            $('#permsTable').DataTable({
                retrieve: true,
                processing: true,
                serverSide: true,
                ajax: '/perms/show/list/'+idDoc,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'hasPerms', render: function (data) {
                            //indica tipo de permisos (si tiene)
                            if (data == 1) {
                                return "<span>Escritura</span>";
                            }
                            else {
                                return "<span>Sin permisos</span>";
                            }
                        }
                    },
                    {data: 'hasPerms', className: 'text-center', render: function (data) {
                            //botones para gestión de permisos (otorgar o eliminar)
                            if (data == 1) {
                                return "<button class='eliminarPerm btn-link btn-xs'>Eliminar permisos</button>";
                            }
                            else {
                                return "<button class='otorgarPerm btn-link btn-xs'>Otorgar permisos</button>";
                            }
                        }
                    }
                ],
                'language': {
                    "url": "/datatablesEs"

                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            });

        });

        //Click en Eliminar permisos
       $('#permsTable').on('click', '.eliminarPerm', function (e) {
            e.preventDefault();

            //obtener id del usuario al que se le eliminan los permisos
            var permsTable = $('#permsTable').DataTable();
            var dRow = $(this).parents('tr')[0];
            var dData = permsTable.row(dRow).data();
            var idUser = dData.id;

            //eliminación del permiso
            $.ajax({
                type: 'post',
                url: '/perms/delete',
                data: {
                    id_user: idUser,
                    id_doc: idDoc
                },
                success: function (data) {
                    permsTable.ajax.reload();
                },
                error: function (data) {
                    alert("Error al modificar los permisos");
                },
                complete: {
                }
            });

        });

        //Click en Otorgar permisos
        $('#permsTable').on('click', '.otorgarPerm', function (e) {
            e.preventDefault();

            //obtener id del usuario al que se le otorgan permisos
            var permsTable = $('#permsTable').DataTable();
            var dRow = $(this).parents('tr')[0];
            var dData = permsTable.row(dRow).data();
            var idUser = dData.id;

            //adjudicación del permiso
            $.ajax({
                type: 'post',
                url: '/perms/new',
                data: {
                    id_user: idUser,
                    id_doc: idDoc
                },
                success: function (data) {
                    permsTable.ajax.reload();
                },
                error: function (data) {
                    alert("Error al modificar los permisos");
                },
                complete: {
                }
            });
        });
    });
