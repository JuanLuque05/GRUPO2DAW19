<?php
    include "Config.php";
    $con = new mysqli(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
    
    if ($con->connect_error) {
        die('Error de Conexión (' . $con->connect_errno . ') '. $con->connect_error);
    }
    else {
        $con->query("DROP DATABASE IF EXISTS " . Config::$mvc_bd_nombre . ";");
        
        if ($con->query("CREATE SCHEMA " . Config::$mvc_bd_nombre . ";") === TRUE) {
            printf("Se creó con exito la base de datos " . Config::$mvc_bd_nombre .  ".<br>");
        }
        if ($con->query("USE " . Config::$mvc_bd_nombre . ";") === TRUE) {
            printf("Usando la base de datos " . Config::$mvc_bd_nombre . ".<br>");
        }
        $tabla = file_get_contents('alimentos.sql');
        if ($con->query($tabla) === TRUE) {
            printf("Creada la tabla usuario en " . Config::$mvc_bd_nombre . ".<br>");
        }
        $con->close();
    }
?>