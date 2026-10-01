<?php

require_once __DIR__ . "/../models/gasto.php";
require_once __DIR__ . "/../models/categoria.php";
require_once __DIR__ . "/../models/departamento.php";

class gastoController {

    public function index(){
        try {
            $gasto = new Gasto();
            $gastos = $gasto->getAll();

            require_once __DIR__ . "/../views/gasto/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de gasto";
        }
    }

    public function crear(){
        try {
            $categoriaModel = new Categoria();
            $departamentoModel = new Departamento();

            $categorias = $categoriaModel->getAll();
            $departamentos = $departamentoModel->getAll();

            require_once __DIR__ . "/../views/gasto/crear.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de gasto al mostrar el formulario";
        }
    }
}
