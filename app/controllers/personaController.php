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
}
