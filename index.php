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

        .botones {
            display: flex;
            border-top: 1px solid black;
            width: fit-content;
            margin-top: 20px;
        }

        .botones input {
            margin: 10px;
        }

        .botones button {
            margin: 10px;

        }

        .editar {
            color: white;
            background-color: blue;
        }

        .eliminar {
            color: white;
            background-color: red;
        }

        td {
            border-top: 1px solid black;
            /* border-bottom: 1px solid black; */
        }

        tr:last-child td {
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    include("settings.php");
    include("conexionBD.php");
    include("funcionesBD.php");
    include("persona.php");
    $personas = null;
    if ($_SERVER["REQUEST_METHOD"] == "GET" || isset($_POST["cargarTodos"])) {
        $personas = leerTodos();
    } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["leer"])) {
        $personas = leerUsuarioPorNombre($_POST["nombreBuscar"]);
    } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["crear"])) {
        $persona = new Persona(null, $_POST['nombre'], $_POST['apellido'], $_POST['edad'], $_POST['fecha-nacimiento']);
    } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modificar"])) {
        $persona = new Persona($_POST["id"], $_POST['nombre'], $_POST['apellido'], $_POST['edad'], $_POST['fecha-nacimiento']);
    } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
        $personas = leerTodos();
    }
    if ($personas !== null) {
        echo "<table>";
        echo "<tr class='linea'><th>Nombre</th><th>Apellidos</th><th>Edad</th><th>Fecha de Nacimiento</th></tr>";
        foreach ($personas as $p) {


            // estructura tabla
            echo "<tr class='linea'>
                    <td>" . $p->getNombre() . "</td>
                    <td>" . $p->getApellido() . "</td>
                    <td>" . $p->getEdad() . "</td>
                    <td>" . $p->getFechaNacimiento() . "</td>
                    <td>"
    ?>
            <form action="editar.php" method="post">
                <input type="hidden" name="idmodificar" value="<?php echo $p->getId(); ?>">
                <input type="submit" value="Editar" class="editar">
            </form>
            <?php

            echo "    </td>
            <td>"
            ?>
            <form action="eliminar.php" method="post">
                <input type="hidden" name="idEliminar" value="<?php echo $p->getId(); ?>">
                <input type="submit" value="Eliminar" name="eliminar" class="eliminar">
            </form>
    <?php

            echo "    </td>                            
                </tr>";
        }
        echo "</table>";
    }
    ?>
    <div class="botones">
        <form action="" method="post">
            <input type="submit" value="Cargar Todos" name="cargarTodos">
        </form>
        <a href="./formLeer.php">
            <button>Buscar Usuario</button>

        </a>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        ?>
            <a href="./formCrear.php">
                <button>Añadir Usuario</button>
            </a>
        <?php
        }
        ?>
    </div>
</body>

</html>