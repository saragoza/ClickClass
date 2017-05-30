$(document).ready(function(){

    //cabecera ajax
    $.ajaxPrefilter(function (options, originalOptions, xhr) {
        var token = $('meta[name="csrf-token"]').attr('content');
        if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    });


    //cargar datos en datatable
    $(function (){
        $('#docsTable').DataTable({
            retrieve: true,
            processing: true,
            serverSide: true,
            ajax: '/docs/list',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'filename', name: 'filename'},
                {data: 'description', name: 'description'},
                {data: 'type', name: 'type'},
                //columna tags oculta para el usuario, pero incluida para resultados del filtrador
                {data: 'tags', name: 'tags', visible: false},
                {data: 'buttons', className: 'text-center', render: function () {
                        //botones para gestión de archivos
                        return "<button class='detalle btn-link btn-xs'>Detalle</button><button class='descargar btn-link btn-xs'>Descargar</button>";
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
    $('#docsTable').on('click', '.detalle', function (e) {
        e.preventDefault();

        //obtener id del archivo
        var docsTable = $('#docsTable').DataTable();
        var dRow = $(this).parents('tr')[0];
        var dData = docsTable.row(dRow).data();
        var id = dData.id;

        //redireccionamiento
        var urlDetalle = '/docs/show/'+id;
        window.location = urlDetalle;
    });

    $('#docsTable').on('click', '.descargar', function (e) {
        e.preventDefault();

        //obtener id del archivo
        var docsTable = $('#docsTable').DataTable();
        var dRow = $(this).parents('tr')[0];
        var dData = docsTable.row(dRow).data();
        var id = dData.id;

        //redireccionamiento
        var urlDescargar = '/docs/download/'+id;
        window.location = urlDescargar;
    });

});
