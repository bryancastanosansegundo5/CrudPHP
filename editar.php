<?php
include("settings.php");
include("persona.php");
include("funcionesBD.php");
$id = isset($_POST['idmodificar']) ? $_POST['idmodificar'] : (isset($_POST['id']) ? $_POST['id'] : '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hayErrores = false;
    $errores = [];

    // Validación nombre
    if (empty($_POST['nombre']) || !preg_match('/^[a-zA-Z\s]+$/', $_POST['nombre'])) {
        $errores['nombre'] = "Introduce un nombre válido (solo letras y espacios)";
        $hayErrores = true;
    }

    // Validación apellido
    if (empty($_POST['apellido']) || !preg_match('/^[a-zA-Z\s]+$/', $_POST['apellido'])) {
        $errores['apellido'] = "Introduce un apellido válido (solo letras y espacios)";
        $hayErrores = true;
    }

    // Validación edad
    if (empty($_POST['edad']) || !preg_match('/^\d{1,3}$/', $_POST['edad']) || $_POST['edad'] < 0 || $_POST['edad'] > 100) {
        $errores['edad'] = "Introduce una edad válida (entre 0 y 100)";
        $hayErrores = true;
    }

    // Validación fecha de nacimiento
    if (empty($_POST['fecha-nacimiento']) || !preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $_POST['fecha-nacimiento'])) {
        $errores['fecha-nacimiento'] = "Introduce una fecha de nacimiento con este formato YYYY-MM-DD";
        $hayErrores = true;
    }

    if (!$hayErrores) {
        if (!empty($id)) {
            $persona = new Persona($id, $_POST['nombre'], $_POST['apellido'], $_POST['edad'], $_POST['fecha-nacimiento']);
            actualizarUsuario($persona);
            echo "<h2 class='anadir'>Usuario actualizado correctamente.</h2>";
        } else {
            echo "<p class='error'>Error: ID de usuario no encontrado.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">

    <title>Document</title>
    <style>
        .error {
            color: red;
            font-weight: bold;
        }

        .anadir {
            color: green;
            font-weight: bold;
        }
        form input{
            margin: 10px;
        }
        .inicio{
            margin: 10px;
        }
        .generar{
            background-color: green;
            color: white;
        }
    </style>
</head>

<body>

    <form action="" method="post">
        <br>
        <h1>Campos para modificar un usuario</h1>
        <!-- id -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <br>
        <!-- nombre -->
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre"
            value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>"
            id="" placeholder="Nombre">
        <?php if (isset($errores['nombre'])) echo '<span class="error">' . $errores['nombre'] . '</span>'; ?>
        <br>
        <!-- apellido -->
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido"
            value="<?php echo isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : ''; ?>"
            id="" placeholder="Apellido">
        <?php if (isset($errores['apellido'])) echo '<span class="error">' . $errores['apellido'] . '</span>'; ?>
        <br>
        <!-- edad -->
        <label for="edad">Edad</label>
        <input type="number" name="edad"
            id="" placeholder="Introduce una edad"
            value="<?php echo isset($_POST['edad']) ? ($_POST['edad']) : ''; ?>">
        <?php if (isset($errores['edad'])) echo '<span class="error">' . $errores['edad'] . '</span>'; ?>
        <br>
        <!-- fecha nacimiento -->
        <label for="fecha-nacimiento">Fecha nacimiento</label>
        <input type="text" name="fecha-nacimiento"
            id="" placeholder="Introduce una fecha de nacimiento"
            value="<?php echo isset($_POST['fecha-nacimiento']) ? htmlspecialchars($_POST['fecha-nacimiento']) : ''; ?>">
        <?php if (isset($errores['fecha-nacimiento'])) echo '<span class="error">' . $errores['fecha-nacimiento'] . '</span>'; ?>
        <br>
        
        <input type="hidden" name="modificar" value="1">
        <input type="submit" name="anadirUsuario" value="Generar" class="generar">
    </form>
        <a href="index.php">
            <button class="inicio">Inicio</button>
        </a>

</body>

</html>