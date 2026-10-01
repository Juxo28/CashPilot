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
}
