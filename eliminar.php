<?php
include("settings.php");
include("persona.php");
include("funcionesBD.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">

    <title>Document</title>
    <style>
        .botones {
            display: flex;
            border-top: 1px solid black;
            width: fit-content;
            margin-top: 20px;
        }

        .botones form {
            margin: 10px;
        }

        .eliminar {
            background-color: red;
            color: white;
        }

        .cancelar {
            background-color: green;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Usuario a eliminar</h1>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idEliminar'])) {
        $id = isset($_POST['idEliminar']) ? $_POST['idEliminar'] : (isset($_POST['id']) ? $_POST['id'] : ''); // Obtener el ID del usuario
        $usuario = null;

        try {
            $usuario = obtenerUsuarioPorId($id);
        } catch (Exception $e) {
            echo "<p class='error'>Error al recuperar los datos del usuario: " . $e->getMessage() . "</p>";
        }

        if ($usuario) {
    ?>

            <h2>¿Estás seguro que deseas eliminar a:</h2>

            <p>Nombre: <?php echo $usuario->getNombre() ?></p>
            <p>Apellidos: <?php echo $usuario->getApellido() ?></p>
            <p>Edad: <?php echo $usuario->getEdad() ?> </p>
            <p>Fecha de nacimiento: <?php echo $usuario->getFechaNacimiento() ?></p>

            <div class="botones">

                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $usuario->getId() ?>">
                    <input type="submit" name="eliminar" value="Confirmar" class="eliminar">
                </form>

                <form action="index.php" method="get">
                    <input type="submit" value="Cancelar" name="cancelar" class="cancelar">
                </form>
            </div>


    <?php
        } else {
            echo "<p class='error'>El usuario no existe o no se pudo recuperar.</p>
        ";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        borrarUsuario($_POST['id']);
        echo "<h2>Usuario eliminado correctamente.</h2>";

        echo '<a href="index.php"><button>Volver al inicio</button></a>';
    }



// funcion para obtener todos los datos del usuario
    function obtenerUsuarioPorId($id)
    {
        $conexion = new mysqli(IP, USUARIO, CLAVE, BD);

        $consulta = $conexion->stmt_init();
        $consulta = $conexion->prepare("SELECT * FROM dwes WHERE id LIKE ?");
        $consulta->bind_param("i", $id);
        $consulta->execute();
        $resultado = $consulta->get_result();

        $personas = null;
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $personas = new Persona($fila['id'], $fila['nombre'], $fila['apellidos'], $fila['edad'], $fila['fecha-nacimiento']);
            }
        }

        $conexion->close();
        return $personas;
    }
    ?>
</body>

</html>