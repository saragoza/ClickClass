$(document).ready(function(){

    //cabecera ajax
    $.ajaxPrefilter(function (options, originalOptions, xhr) {
        var token = $('meta[name="csrf-token"]').attr('content');
        if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    });


    //cargar datos en datatables
    $(function (){
        $('#myDocsTable').DataTable({
            retrieve: true,
            processing: true,
            serverSide: true,
            ajax: '/mylist',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'filename', name: 'filename'},
                {data: 'description', name: 'description'},
                {data: 'type', name: 'type'},
                //columna tags oculta para el usuario, pero incluida para resultados del filtrador
                {data: 'tags', name: 'tags', visible: false},
                {data: 'owner', className: 'text-center', render: function (data) {
                        //botones para gestión de archivos (propietarios y usuarios con permisos)
                        var buttons = "<button class='detalle btn-link btn-xs'>Detalle</button><button class='descargar btn-link btn-xs'>Descargar</button><button class='editar btn-link btn-xs'>Editar</button>";
                        //botones para gestión de archivos (activados solamente para propietarios)
                        var userAuth = $('#userAuth').val();
                        if (data == userAuth) {
                            buttons += "<button type='button' class='permisos btn-link btn-xs'>Permisos</button><button class='eliminar btn-link btn-xs'>Eliminar</button>";
                        }
                        else {
                            buttons += "<button class='permisos btn-link btn-xs' style='color:#DDD' disabled>Permisos</button><button class='eliminar btn-link btn-xs' style='color:#DDD' disabled>Eliminar</button>";
                        }
                        return buttons;
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


    //Click en botón Detalle
    $('#myDocsTable').on('click', '.detalle', function (e) {
        e.preventDefault();

        //obtener id del archivo
        var myDocsTable = $('#myDocsTable').DataTable();
        var dRow = $(this).parents('tr')[0];
        var dData = myDocsTable.row(dRow).data();
        var id = dData.id;

        //redireccionamiento
        var urlDetalle = '/docs/show/'+id;
        window.location = urlDetalle;
    });

    $('#myDocsTable').on('click', '.descargar', function (e) {
        e.preventDefault();

        //obtener id del archivo
        var myDocsTable = $('#myDocsTable').DataTable();
        var dRow = $(this).parents('tr')[0];
        var dData = myDocsTable.row(dRow).data();
        var id = dData.id;

        //redireccionamiento
        var urlDescargar = '/docs/download/'+id;
        window.location = urlDescargar;
    });

    $('#myDocsTable').on('click', '.editar', function (e) {
        e.preventDefault();

        //obtener id del archivo
        var myDocsTable = $('#myDocsTable').DataTable();
        var dRow = $(this).parents('tr')[0];
        var dData = myDocsTable.row(dRow).data();
        var id = dData.id;

        //redireccionamiento
        var urlEditar = '/docs/edit/'+id;
        window.location = urlEditar;
    });

    $('#myDocsTable').on('click', '.permisos', function (e) {
        e.preventDefault();

        //obtener id del archivo
        var myDocsTable = $('#myDocsTable').DataTable();
        var dRow = $(this).parents('tr')[0];
        var dData = myDocsTable.row(dRow).data();
        var id = dData.id;

        //redireccionamiento
        var urlPermisos = '/perms/show/'+id;
        window.location = urlPermisos;
    });

    $('#myDocsTable').on('click', '.eliminar', function (e) {
        e.preventDefault();
        //obtener id del archivo, si confirmada eliminación
        var myDocsTable = $('#myDocsTable').DataTable();
        var dRow = $(this).parents('tr')[0];
        var dData = myDocsTable.row(dRow).data();

        var ok = confirm("¿Desea eliminar el archivo?");
        if (ok){
            var id = dData.id;
            //eliminación
            $.ajax({
                type: 'post',
                url: '/docs/delete',
                data: {
                    id: id
                },
                success: function (data) {
                    myDocsTable.row(dRow).remove();
                    myDocsTable.draw();
                    alert("Archivo eliminado con éxito");
                },
                error: function (data) {
                    alert("Error al eliminar el archivo");
                },
                complete: {
                }
            });
        }
    });

});
