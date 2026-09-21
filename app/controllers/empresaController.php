<?php

require_once __DIR__ . "/../models/empresa.php";

class empresaController {
    public function index(){
        try {
            $empresa = new Empresa();

            $empresas = $empresa->getAll();

            $empresaConsultada = $empresa->getById("0 or 1=1");

            require_once __DIR__ . "/../views/empresa/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de empresa";
        }
    }
}