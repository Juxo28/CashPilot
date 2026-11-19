<?php

require_once __DIR__ . "/../models/categoria.php";

class categoriaController
{
    public function index()
    {
        try {
            $categoria = new Categoria();
            $categorias = $categoria->getAll();

            require_once __DIR__ . "/../views/categoria/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de categoria: " . $e->getMessage();
        }
    }

    public function crear()
    {
        require_once __DIR__ . "/../views/categoria/crear.php";
    }

    public function guardar()
    {
        $id_empresa = 1; // temporal, hasta que exista el login

        $nombre_categoria = $_POST['nombre_categoria'];
        $tipo_categoria = $_POST['tipo_categoria'];
        $descripcion = $_POST['descripcion'];

        $categoria = new Categoria();
        $resultado = $categoria->guardar($id_empresa, $nombre_categoria, $tipo_categoria, $descripcion);

        if ($resultado) {
            echo "<p>Categoria guardada correctamente</p>";
        } else {
            echo "<p>No se pudo guardar la informacion</p>";
        }

        $this->index();
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        $categoriaM = new Categoria();
        $categoria = $categoriaM->getByid($id);

        if (!$categoria) {
            echo "<p>La categoria no existe</p>";
            return $this->index();
        }

        require_once __DIR__ . "/../views/categoria/editar.php";
    }

    public function actualizar()
    {
        $id = $_POST['id_categoria'];
        $nombre = $_POST['nombre_categoria'];
        $tipo = $_POST['tipo_categoria'];
        $descripcion = $_POST['descripcion'];

        $categoria = new Categoria();
        if ($categoria->actualizar($id, $nombre, $tipo, $descripcion)) {
            echo "<p>Categoria actualizada correctamente</p>";
        }

        return $this->index();
    }

    public function eliminar()
    {
        $id = $_POST['id_categoria'];

        try {
            $categoria = new Categoria();
            $categoria->eliminar($id);
            echo "<p>Categoria eliminada correctamente</p>";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<p>No se puede eliminar la categoria porque tiene gastos o ingresos asociados.</p>";
            } else {
                echo "<p>Ocurrió un error al intentar eliminar la categoria.</p>";
            }
        }

        return $this->index();
    }
}
