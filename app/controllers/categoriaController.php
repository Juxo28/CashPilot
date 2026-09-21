<?php

require_once __DIR__ . "/../models/categoria.php";

class categoriaController {
    public function index(){
        try {
            $categoria = new Categoria();
            $categorias = $categoria->getAll();
            $categoriaConsultado = $categoria->getById("0 or 1=1");

            require_once __DIR__ . "/../views/categoria/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de categoria";
        }
    }
}