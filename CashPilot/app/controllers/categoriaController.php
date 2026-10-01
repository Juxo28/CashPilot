<?php

require_once __DIR__ . "/../models/categoria.php";

class categoriaController {

    public function index(){
        try {
            $categoria = new Categoria();
            $categorias = $categoria->getAll();

            require_once __DIR__ . "/../views/categoria/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de categoria";
        }
    }

    public function crear(){
        require_once __DIR__ . "/../views/categoria/crear.php";
    }

    public function guardar(){
        try {
            $id_empresa = 1; // por ahora fijo, hasta que exista el login
            $nombre_categoria = $_GET['nombre_categoria'];
            $tipo_categoria = $_GET['tipo_categoria'];
            $descripcion = $_GET['descripcion'];

            if ($nombre_categoria == "" || ($tipo_categoria != "ingreso" && $tipo_categoria != "gasto")) {
                echo "El nombre es obligatorio y el tipo debe ser ingreso o gasto";
                require_once __DIR__ . "/../views/categoria/crear.php";
                return;
            }

            $categoria = new Categoria();
            $resultado = $categoria->create($id_empresa, $nombre_categoria, $tipo_categoria, $descripcion);

            if ($resultado) {
                header("Location: /categoria");
            } else {
                echo "No se pudo guardar. Revisa los datos e intenta de nuevo.";
                require_once __DIR__ . "/../views/categoria/crear.php";
            }
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de categoria al guardar";
        }
    }
}
