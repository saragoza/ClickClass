<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CONEXIÓN Y ACTUALIZACIÓN DE LA BASE DE DATOS DWES</title>
    </head>
    <body>
        <?php
            $dwes = new msqli('localhost', 'dwes', 'abc123.', 'dwes');
            $error = $dwes->connect_errno;
            if ($error != null){
                echo "<p>Error $error conectando a la base de datos: $dwes->connect_error</p>";
                exit();
            }
            $dwes->autocommit(false);
            $correcto = true;
            if ($dwes->query('UPDATE stock SET unidades = 1 WHERE tienda = 1 AND producto = "3DSNG"') != true)
                $correcto = false;
            if ($dwes->query('INSERT INTO stock (producto, tienda, unidades) VALUES ("3DSNG", 3, 1)') != true)
                $correcto = false;
            if ($correcto == true){
                $dwes->commit();
                echo "<p>Los cambios se han realizado correctamente</p>";
            }else{
                $dwes->rollback();
                echo "<p>No se han podido realizar los cambios</p>";
            }
            $dwes->close();
            unset($dwes);
        ?>
    </body>
</html>
