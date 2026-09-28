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

    public function guardar(){
        try {
            $id_empresa = 1;
            $id_persona = $_POST['id_persona'];
            $id_rol = $_POST['id_rol'];
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            if ($id_persona == "" || $id_rol == "" || $usuario == "" || strlen($password) < 8) {
                echo "Todos los campos son obligatorios y la contraseña debe tener al menos 8 caracteres";
                $personaModel = new PersonaModel();
                $rolModel = new Rol();
                $personas = $personaModel->getAll();
                $roles = $rolModel->getAll();
                require_once __DIR__ . "/../views/usuario/crear.php";
                return;
            }

            $usuarioModel = new Usuario();
            $resultado = $usuarioModel->create($id_empresa, $id_persona, $id_rol, $usuario, $password);

            if ($resultado) {
                header("Location: /usuario");
            } else {
                echo "No se pudo guardar. Revisa los datos e intenta de nuevo.";
                $personaModel = new PersonaModel();
                $rolModel = new Rol();
                $personas = $personaModel->getAll();
                $roles = $rolModel->getAll();
                require_once __DIR__ . "/../views/usuario/crear.php";
            }
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de usuario al guardar";
        }
    }
}
