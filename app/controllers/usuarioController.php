<?php

require_once __DIR__ . "/../models/usuario.php";
require_once __DIR__ . "/../models/personaModel.php";
require_once __DIR__ . "/../models/rol.php";

class usuarioController {

    public function index(){
        try {
            $usuario = new Usuario();
            $usuarios = $usuario->getAll();

            require_once __DIR__ . "/../views/usuario/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de usuario";
        }
    }

    public function crear(){
        try {
            $personaModel = new PersonaModel();
            $rolModel = new Rol();

            $personas = $personaModel->getAll();
            $roles = $rolModel->getAll();

            require_once __DIR__ . "/../views/usuario/crear.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de usuario al mostrar el formulario";
        }
    }
}
