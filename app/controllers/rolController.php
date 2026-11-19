<?php

require_once __DIR__ . "/../models/rol.php";

class rolController
{
    public function index()
    {
        try {
            $rol = new Rol();
            $roles = $rol->getAll();

            require_once __DIR__ . "/../views/rol/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de rol: " . $e->getMessage();
        }
    }

    public function crear()
    {
        require_once __DIR__ . "/../views/rol/crear.php";
    }

    public function guardar()
    {
        $nombre_rol = $_POST['nombre_rol'];
        $descripcion = $_POST['descripcion'];

        $rol = new Rol();
        if ($rol->guardar($nombre_rol, $descripcion)) {
            echo "<p>Rol guardado correctamente</p>";
        } else {
            echo "<p>No se pudo guardar la informacion</p>";
        }

        $this->index();
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        $rolM = new Rol();
        $rol = $rolM->getByid($id);

        if (!$rol) {
            echo "<p>El rol no existe</p>";
            return $this->index();
        }

        require_once __DIR__ . "/../views/rol/editar.php";
    }

    public function actualizar()
    {
        $id = $_POST['id_rol'];
        $nombre_rol = $_POST['nombre_rol'];
        $descripcion = $_POST['descripcion'];

        $rol = new Rol();
        if ($rol->actualizar($id, $nombre_rol, $descripcion)) {
            echo "<p>Rol actualizado correctamente</p>";
        }

        return $this->index();
    }

    public function eliminar()
    {
        $id = $_POST['id_rol'];

        try {
            $rol = new Rol();
            $rol->eliminar($id);
            echo "<p>Rol eliminado correctamente</p>";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<p>No se puede eliminar el rol porque hay usuarios que lo tienen asignado.</p>";
            } else {
                echo "<p>Ocurrió un error al intentar eliminar el rol.</p>";
            }
        }

        return $this->index();
    }
}
