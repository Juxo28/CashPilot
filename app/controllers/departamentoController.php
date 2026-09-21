<?php

require_once __DIR__ . "/../models/departamento.php";

class departamentoController {
    public function index(){
        try {
            $departamento = new Departamento();

            $departamentos = $departamento->getAll();

            $departamentoConsultado = $departamento->getById(6);

            require_once __DIR__ . "/../views/departamento/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de departamento";
        }
    }
}