<?php

require_once __DIR__ . "/../models/rol.php";

class rolController {

    public function index(){
        try {
            $rol = new Rol();
            $roles = $rol->getAll();

            require_once __DIR__ . "/../views/rol/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de rol";
        }
    }

    public function crear(){
        require_once __DIR__ . "/../views/rol/crear.php";
    }

    public function guardar(){
        try {
            $nombre_rol = $_POST['nombre_rol'];
            $descripcion = $_POST['descripcion'];

            if ($nombre_rol == "") {
                echo "El nombre del rol es obligatorio";
                require_once __DIR__ . "/../views/rol/crear.php";
                return;
            }

            $rol = new Rol();
            $resultado = $rol->create($nombre_rol, $descripcion);

            if ($resultado) {
                header("Location: /rol");
            } else {
                echo "No se pudo guardar. Revisa los datos e intenta de nuevo.";
                require_once __DIR__ . "/../views/rol/crear.php";
            }
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de rol al guardar";
        }
    }
}
