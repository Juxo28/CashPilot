<?php

require_once __DIR__ . "/../models/ingreso.php";
require_once __DIR__ . "/../models/categoria.php";

class ingresoController
{
    // Temporales, hasta que exista el login (el usuario 1 pertenece a la empresa 1)
    private $id_empresa = 1;
    private $id_usuario = 1;

    public function index()
    {
        try {
            $ingreso = new Ingreso();
            $ingresos = $ingreso->getAll();

            require_once __DIR__ . "/../views/ingreso/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de ingreso: " . $e->getMessage();
        }
    }

    // Solo categorias de tipo ingreso de la empresa
    private function cargarCategorias()
    {
        $categoriaModel = new Categoria();

        $categorias = [];
        foreach ($categoriaModel->getByEmpresa($this->id_empresa) as $categoria) {
            if ($categoria['tipo_categoria'] == 'ingreso') {
                $categorias[] = $categoria;
            }
        }

        return $categorias;
    }

    public function crear()
    {
        try {
            $categorias = $this->cargarCategorias();

            require_once __DIR__ . "/../views/ingreso/crear.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de ingreso al mostrar el formulario: " . $e->getMessage();
        }
    }

    public function guardar()
    {
        $id_categoria = $_POST['id_categoria'];
        $monto = $_POST['monto'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $fuente = $_POST['fuente'] !== '' ? $_POST['fuente'] : null;

        $ingreso = new Ingreso();
        $resultado = $ingreso->guardar($this->id_empresa, $this->id_usuario, $id_categoria,
                                       $monto, $fecha, $descripcion, $fuente);

        if ($resultado) {
            echo "<p>Ingreso guardado correctamente</p>";
        } else {
            echo "<p>No se pudo guardar la informacion</p>";
        }

        $this->index();
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        try {
            $ingresoM = new Ingreso();
            $ingreso = $ingresoM->getByid($id);

            if (!$ingreso) {
                echo "<p>El ingreso no existe</p>";
                return $this->index();
            }

            $categorias = $this->cargarCategorias();

            require_once __DIR__ . "/../views/ingreso/editar.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de ingreso al editar: " . $e->getMessage();
        }
    }

    public function actualizar()
    {
        $id = $_POST['id_ingreso'];
        $id_categoria = $_POST['id_categoria'];
        $monto = $_POST['monto'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $fuente = $_POST['fuente'] !== '' ? $_POST['fuente'] : null;

        $ingreso = new Ingreso();
        if ($ingreso->actualizar($id, $id_categoria, $monto, $fecha, $descripcion, $fuente)) {
            echo "<p>Ingreso actualizado correctamente</p>";
        }

        return $this->index();
    }

    public function eliminar()
    {
        $id = $_POST['id_ingreso'];

        try {
            $ingreso = new Ingreso();
            $ingreso->eliminar($id);
            echo "<p>Ingreso eliminado correctamente</p>";
        } catch (PDOException $e) {
            echo "<p>Ocurrió un error al intentar eliminar el ingreso.</p>";
        }

        return $this->index();
    }
}
