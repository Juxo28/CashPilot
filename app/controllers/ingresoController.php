<?php

require_once __DIR__ . "/../models/ingreso.php";
require_once __DIR__ . "/../models/categoria.php";

class ingresoController {

    public function index(){
        try {
            $ingreso = new Ingreso();
            $ingresos = $ingreso->getAll();

            require_once __DIR__ . "/../views/ingreso/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de ingreso";
        }
    }

    public function crear(){
        try {
            $categoriaModel = new Categoria();
            $categorias = $categoriaModel->getAll();

            require_once __DIR__ . "/../views/ingreso/crear.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de ingreso al mostrar el formulario";
        }
    }
}
