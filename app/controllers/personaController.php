<?php

require_once __DIR__ . "/../models/personaModel.php";

class personaController {

    public function index(){
        try {
            $persona = new PersonaModel();
            $personas = $persona->getAll();

            require_once __DIR__ . "/../views/persona/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de persona";
        }
    }

    public function crear(){
        require_once __DIR__ . "/../views/persona/crear.php";
    }

    public function guardar(){
        try {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];

            if ($nombre == "" || $apellido == "") {
                echo "El nombre y el apellido son obligatorios";
                require_once __DIR__ . "/../views/persona/crear.php";
                return;
            }

            $persona = new PersonaModel();
            $resultado = $persona->create($nombre, $apellido, $telefono, $correo);

            if ($resultado) {
                header("Location: /persona");
            } else {
                echo "No se pudo guardar. Revisa los datos e intenta de nuevo.";
                require_once __DIR__ . "/../views/persona/crear.php";
            }
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de persona al guardar";
        }
    }
}
