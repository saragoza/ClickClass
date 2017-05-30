 $(document).ready(function(){
     //animación inicio
    function showImages(){
        $("#marco-inicio-1").fadeTo(1500, 1, function(){
        });
    }

    showImages();

     //envío de formulario
     //se hace así para que no interfiera con el uso de bootstrap-tagsinput (se utiliza ENTER para crear tags)
    $("#submitShareForm").on("click", function() {
        $("#shareForm").submit();
    });

     //situa el cursor al principio del textarea al hacer click dentro
    $("textarea").on("click", function() {
        $("textarea").caretToStart();
    });

});
