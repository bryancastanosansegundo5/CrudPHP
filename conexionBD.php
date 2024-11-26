<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["cargarBBDD"])) {
    try {
        $conexion = new mysqli(IP, USUARIO, CLAVE);
        $comands = file_get_contents("./dwes.sql");
        $conexion->multi_query($comands);
    } catch (Exception $e) {
        echo $e;
        echo "ha habido un problema al cargar la BBDD de ejemplo";
    } finally {
        $conexion->close();
    }
}
