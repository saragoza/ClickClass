<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DTable extends Controller
{
    public function datatablesEs(){
        $jsonDatatable='{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ Registros",
            "sZeroRecords":    "No se han encontrado resultados",
            "sEmptyTable":     "No hay datos disponibles",
            "sInfo":           "_START_ - _END_ de _TOTAL_",
            "sInfoEmpty":      "No hay elementos que mostrar",
            "sInfoFiltered":   "(filtrado de un total de _MAX_)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "&#8249;&#8249;",
                "sLast":     "&#8250;&#8250;",
                "sNext":     "&#8250;",
                "sPrevious": "&#8249;"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }';
        return $jsonDatatable;
    }

    public function showHelp() {
        return view('layouts.help');
    }
}
