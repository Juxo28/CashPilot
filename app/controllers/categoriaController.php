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

    public function guardar()
{
    $id_empresa = 1; // temporal, hasta que exista el login

    $nombre_categoria = $_POST['nombre_categoria'];
    $tipo_categoria = $_POST['tipo_categoria'];
    $descripcion = $_POST['descripcion'];

    $categoria = new Categoria();
    $resultado = $categoria->create($id_empresa, $nombre_categoria, $tipo_categoria, $descripcion);

    if ($resultado) {
        echo "Categoria guardada correctamente";
        $this->index();
    } else {
        echo "No se pudo guardar la informacion";
    }
}
}
