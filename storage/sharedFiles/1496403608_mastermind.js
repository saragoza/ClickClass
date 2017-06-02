//muestra la combinación que había que adivinar cuando se gana o se pierde la partida
function mostrarSolucion(){
    var rutas = document.getElementById("combinacion").value.split(",");
    var solucion = document.getElementById("fila1").getElementsByTagName("img");
    for (var i=0; i<rutas.length; i++){
        solucion[i].src = rutas[i];
        solucion[i].className = "colores";
    }
}

//activa todos los botones menos NUEVO JUEGO
function activar(){
    document.getElementById("verificar").disabled=false;
    document.getElementById("boton_rojo").disabled=false;
    document.getElementById("boton_verde").disabled=false;
    document.getElementById("boton_amarillo").disabled=false;
    document.getElementById("boton_azul").disabled=false;
}


//desactiva todos los botones menos NUEVO JUEGO
function desactivar(){
    document.getElementById("verificar").disabled=true;
    document.getElementById("boton_rojo").disabled=true;
    document.getElementById("boton_verde").disabled=true;
    document.getElementById("boton_amarillo").disabled=true;
    document.getElementById("boton_azul").disabled=true;
}

//Función que genera la combinación que hay que acertar
function generar(){
    var array=new Array();
    //generación aleatoria de cuatro colores, que es la combinación a acertar
    for (var i=0; i<=3; i++){
        var azar = Math.floor(Math.random() * 4);
        switch (azar) {
                case 0: array[i] = "imagenes/rojo.png"; break;
                case 1: array[i] = "imagenes/verde.png"; break;
                case 2: array[i] = "imagenes/amarillo.png"; break;
                case 3: array[i] = "imagenes/azul.png"; break;
        }
    }
    //se almacenan en un campo oculto
    document.getElementById("combinacion").value = array;
}


//Función que rellena la primera fila con el color seleccionado
function rellenar(event) {
    //en esta variable guardo el elemento que ha disparado la acción
    var element = event.target;
    //el <td> con id "fila1" es donde se introduce cada jugada. En él se almacenarán los cuatro colores seleccionados por el jugador
    var jugada = document.getElementById("fila1").getElementsByTagName("img");
    //recorremos los elementos <img> que componen "fila1"
    for(var i=0; i < jugada.length; i++){
        var ruta;
        //dependiendo de qué elemento (botón) ha disparado la acción, en la variable ruta guardamos un src u otro
        switch (element.id) {
            case "boton_rojo": ruta = "imagenes/rojo.png"; break;
            case "boton_verde": ruta = "imagenes/verde.png"; break;
            case "boton_amarillo": ruta = "imagenes/amarillo.png"; break;
            case "boton_azul": ruta = "imagenes/azul.png"; break;
        }
        //si el <img> es de la clase "vacío" (no tiene ningún color asociado), le asignamos el src correspondiente al color seleccionado
        //y lo cambiamos a la clase "colores"
        if (jugada[i].className == "vacio"){
            jugada[i].src = ruta;
            jugada[i].className = "colores";
            //salimos del for porque ya hemos asignado el color
            break;
        }
    }
}
//Función que verificar la fila introducida y muestra el resultado
function verificar() {
    //jugada lista para verificar del jugador (una línea completa, cuatro colores seleccionados)
    var jugada = document.getElementById("fila1").getElementsByTagName("img");
    //Si no ha rellenado toda la fila muestra un mensaje y no continúa
    if(jugada[jugada.length-1].className == "vacio"){
        window.alert("Debe rellenar toda la fila");
        return;
    }

    //Verifica el resultado
    //array con el contenido del campo oculto (los src de la combinación a acertar, ruta relativa)
    var rutasCombinacion = document.getElementById("combinacion").value.split(",");
    //casillas en la que se van a mostrar los resultados (fichas blancas y/o negras)
    var casillasResultado = document.getElementById("resultado1").getElementsByTagName("img");
    //variable para hacer recuento de cuántas fichas negras colocamos
    var contadorNegras = 0;
    //recorremos uno por uno los <img> de la jugada
    for (var i=0; i<jugada.length; i++){
        //obtenemos la ruta relativa a partir del <img> de jugada
        var transicion = jugada[i].src.split("/");
        var rutaRelativa = transicion[transicion.length-2]+"/"+transicion[transicion.length-1];
        //si el src del img es igual al de la combinación a acertar, y además está en la misma posición
        if (rutaRelativa == rutasCombinacion[i]){
            //aumentamos el contador de fichas negras
            contadorNegras++;
            //ponemos una ficha negra en la primera casilla de resultado que esté "vacía", y cambiamos su clase a "peque_lleno"
            for (var j=0; j<casillasResultado.length; j++){
                if (casillasResultado[j].className == "peque_vacio"){
                    casillasResultado[j].src = "imagenes/negro.png";
                    casillasResultado[j].className = "peque_lleno";
                    break;
                }
            }
            //quitamos la ruta encontrada del array de la combinación a acertar, para que no valorarlo en la asignación de fichas blancas
            rutasCombinacion[i] = "";
        }
    }
    //si no hemos acertado todos los colores y posiciones...
    if (contadorNegras < 4){
        //si no, volvemos a comparar la jugada con la combinación para asignar fichas blancas (color acertado, posición errónea)
        for (var i=0; i<jugada.length; i++){
            //obtenemos la ruta relativa de esa posición de la jugada
            var transicion = jugada[i].src.split("/");
            var rutaRelativa = transicion[transicion.length-2]+"/"+transicion[transicion.length-1];
            //si rutasCombinación[i] no contiene un cadena vacía, es que no ha sido marcada como color y posición
            //correctos, y por lo tanto habrá que seguir los pasos para colocar las fichas blancas pertinentes
            if (rutasCombinacion[i] !== ""){
                //cada color de la jugada lo comparamos con todos los colores de la combinación a acertar
                for (var j=0; j<rutasCombinacion.length; j++){
                    //si el color de la jugada es igual al de la combinación a acertar...
                    if (rutaRelativa == rutasCombinacion[j]){
                        //marcamos la ruta encontrada del array de la combinación a acertar, para no valorarlo
                        //en el siguiente recorrido de comparación con la jugada
                        rutasCombinacion[j] = "blanca";
                        //ponemos una ficha blanca en la primera casilla de resultado que esté "vacía", y cambiamos su clase a "peque_lleno"
                        for (var k=0; k<casillasResultado.length; k++){
                            if (casillasResultado[k].className == "peque_vacio"){
                                casillasResultado[k].src = "imagenes/blanco.png";
                                casillasResultado[k].className = "peque_lleno";
                                break;
                            }
                        }
                        //dejamos de recorrer la combinación
                        break;
                    }
                }
            }
        }
    }

    //Rellena la fila correspondiente con el resultado
    for(var j=2; j <= 8; j++) {
        //recorremos fila por fila para buscar una "vacía" en la que guardar la jugada
        var nombreCelda = "fila" + j;
        var nombreResultado = "resultado" + j;
        var filaRellenar = document.getElementById(nombreCelda).getElementsByTagName("img");
        var resultadoRellenar = document.getElementById(nombreResultado).getElementsByTagName("img");
        if (filaRellenar[0].className == "vacio"){
            //copiamos la jugada en la primera fila "vacía" que encontremos
            for(var k=0; k < jugada.length; k++){
                filaRellenar[k].src = jugada[k].src;
                filaRellenar[k].className = "colores";
            }
            //y copiamos también el resultado de la jugada
            for(var k=0; k < casillasResultado.length; k++){
                resultadoRellenar[k].src = casillasResultado[k].src;
                resultadoRellenar[k].className = "peque_lleno";
            }
            //Vaciar la primera fila
            for(var k=0; k < jugada.length; k++){
                jugada[k].src = "imagenes/gris.png";
                jugada[k].className = "vacio";
            }
            for(var k=0; k < casillasResultado.length; k++){
                casillasResultado[k].src = "imagenes/gris.png";
                casillasResultado[k].className = "peque_vacio";
            }
            break;
        }
    }
    //si todas las casillas están rellenas y la última fila no tiene cuatro fichas negras...
    if ((j == 8) && (contadorNegras < 4)){
        window.alert("JUEGO TERMINADO, HAS PERDIDO");
        desactivar();
        mostrarSolucion();
        //si la última fila tiene cuatro fichas negras...
    }else if (contadorNegras == 4){
        window.alert("¡¡¡HAS GANADO!!!");
        desactivar();
        mostrarSolucion();
    }

}

function nuevoJuego(){
    location.reload();
}

//Asignar funciones a botones
window.onload = function() {
    generar();
    activar();
  	document.getElementById("boton_rojo").onclick = rellenar;
    document.getElementById("boton_verde").onclick = rellenar;
    document.getElementById("boton_amarillo").onclick = rellenar;
    document.getElementById("boton_azul").onclick = rellenar;
    document.getElementById("verificar").onclick = verificar;
    document.getElementById("nuevo").onclick = nuevoJuego;
}
