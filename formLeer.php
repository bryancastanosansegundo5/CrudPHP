<?php
include("./funcionesBD.php")
?>
<link rel="stylesheet" href="css/styles.css">

<form action="index.php" method="post">
    <label for="nombre">Consultar por Nombre:</label>
    <input type="text" name="nombreBuscar" id="nombre" required>
    <input type="hidden" name="leer" value="1">
    <input type="submit" value="Buscar">
</form>