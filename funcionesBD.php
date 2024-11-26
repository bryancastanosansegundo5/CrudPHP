<?php
// <!-- create -->
function crearUsuario($persona)
{
    try {
        $conexion = new mysqli(IP, USUARIO, CLAVE, BD);

        $sql = "INSERT INTO dwes (id, nombre, apellidos, edad, `fecha-nacimiento`) VALUES (null, ?, ?, ?, ?)";
        $consulta = $conexion->prepare($sql);

        $nombre = $persona->getNombre();
        $apellido = $persona->getApellido();
        $edad = $persona->getEdad();
        $fechaNacimiento = $persona->getFechaNacimiento();

        $consulta->bind_param(
            'ssis', 
            $nombre,
            $apellido,
            $edad,
            $fechaNacimiento
        );

        $consulta->execute();

        $consulta->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conexion->close();
    }
}

// <!-- read -->
function leerUsuarioPorNombre($nombre)
{
    try {
        $conexion = new mysqli(IP, USUARIO, CLAVE, BD);

        $consulta = $conexion->stmt_init();
        $consulta->prepare("SELECT * FROM dwes WHERE nombre LIKE ?");
        $nombre = '%' . $nombre . '%';
        $consulta->bind_param('s', $nombre);
        $consulta->execute();
        $resultado = $consulta->get_result();


        $personas = [];
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $personas[] = new Persona($fila['id'], $fila['nombre'], $fila['apellidos'], $fila['edad'], $fila['fecha-nacimiento']);
            }
        }
        return $personas;
    } catch (\Throwable $th) {
        return "No se encontró un usuario con ese nombre: " . $nombre;
    } finally {
        $consulta->close();
        $conexion->close();
    }
}

// readAll
function leerTodos()
{
    try {
        $conexion = new mysqli(IP, USUARIO, CLAVE, BD);
        $resultado = $conexion->query("select * from dwes");
        $personas = [];
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $persona = new Persona($fila["id"], $fila["nombre"], $fila["apellidos"], $fila["edad"], $fila["fecha-nacimiento"]);
                $personas[] = $persona;
            }
        }
        $conexion->close();
        return $personas;
    } catch (Exception $th) {
        include("./formCargarBBDD.php");
    }
}
// <!-- update -->
function actualizarUsuario($persona)
{
    try {
        $conexion = new mysqli(IP, USUARIO, CLAVE, BD);
        $sql = "UPDATE dwes SET nombre = ?, apellidos = ?, edad = ?, `fecha-nacimiento` = ? WHERE id = ?";
        $consulta = $conexion->prepare($sql);

        $id = $persona->getId();
        $nombre = $persona->getNombre();
        $apellidos = $persona->getApellido();
        $edad = $persona->getEdad();
        $fechaNacimiento = $persona->getFechaNacimiento();

        $consulta->bind_param(
            "ssisi", 
            $nombre,
            $apellidos,
            $edad,
            $fechaNacimiento,
            $id
        );
        $consulta->execute();


        $consulta->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conexion->close();
    }
    return $persona;
}

// <!-- delete -->
function borrarUsuario($id)
{
    try {
        $conexion = new mysqli(IP, USUARIO, CLAVE, BD);

        $sql = "DELETE FROM dwes WHERE id LIKE ?";
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param("i", $id);
        $consulta->execute();

        
    } catch (\Throwable $th) {
        echo "Error: " . $th->getMessage();
    } finally {
        $consulta->close();
        $conexion->close();
    }
}
