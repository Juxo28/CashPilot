<?php

require_once __DIR__ . "/../models/gasto.php";
require_once __DIR__ . "/../models/categoria.php";
require_once __DIR__ . "/../models/departamento.php";

class gastoController
{
    // Temporales, hasta que exista el login (el usuario 1 pertenece a la empresa 1)
    private $id_empresa = 1;
    private $id_usuario = 1;

    public function index()
    {
        try {
            $gasto = new Gasto();
            $gastos = $gasto->getAll();

            require_once __DIR__ . "/../views/gasto/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de gasto: " . $e->getMessage();
        }
    }

    // Carga las listas de los <select>: solo categorias de tipo gasto y departamentos de la empresa
    private function cargarListas()
    {
        $categoriaModel = new Categoria();
        $departamentoModel = new Departamento();

        $categorias = [];
        foreach ($categoriaModel->getByEmpresa($this->id_empresa) as $categoria) {
            if ($categoria['tipo_categoria'] == 'gasto') {
                $categorias[] = $categoria;
            }
        }

        $departamentos = $departamentoModel->getByEmpresa($this->id_empresa);

        return [$categorias, $departamentos];
    }

    public function crear()
    {
        try {
            [$categorias, $departamentos] = $this->cargarListas();

            require_once __DIR__ . "/../views/gasto/crear.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de gasto al mostrar el formulario: " . $e->getMessage();
        }
    }

    public function guardar()
    {
        $id_departamento = $_POST['id_departamento'];
        $id_categoria = $_POST['id_categoria'];
        $monto = $_POST['monto'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $metodo_pago = $_POST['metodo_pago'];
        $comprobante = $_POST['comprobante'] !== '' ? $_POST['comprobante'] : null;

        $gasto = new Gasto();
        $resultado = $gasto->guardar($this->id_empresa, $this->id_usuario, $id_departamento, $id_categoria,
                                     $monto, $fecha, $descripcion, $metodo_pago, $comprobante);

        if ($resultado) {
            echo "<p>Gasto guardado correctamente</p>";
        } else {
            echo "<p>No se pudo guardar la informacion</p>";
        }

        $this->index();
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        try {
            $gastoM = new Gasto();
            $gasto = $gastoM->getByid($id);

            if (!$gasto) {
                echo "<p>El gasto no existe</p>";
                return $this->index();
            }

            [$categorias, $departamentos] = $this->cargarListas();

            require_once __DIR__ . "/../views/gasto/editar.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de gasto al editar: " . $e->getMessage();
        }
    }

    public function actualizar()
    {
        $id = $_POST['id_gasto'];
        $id_departamento = $_POST['id_departamento'];
        $id_categoria = $_POST['id_categoria'];
        $monto = $_POST['monto'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $metodo_pago = $_POST['metodo_pago'];
        $comprobante = $_POST['comprobante'] !== '' ? $_POST['comprobante'] : null;

        $gasto = new Gasto();
        if ($gasto->actualizar($id, $id_departamento, $id_categoria, $monto, $fecha, $descripcion, $metodo_pago, $comprobante)) {
            echo "<p>Gasto actualizado correctamente</p>";
        }

        return $this->index();
    }

    public function eliminar()
    {
        $id = $_POST['id_gasto'];

        try {
            $gasto = new Gasto();
            $gasto->eliminar($id);
            echo "<p>Gasto eliminado correctamente</p>";
        } catch (PDOException $e) {
            echo "<p>Ocurrió un error al intentar eliminar el gasto.</p>";
        }

        return $this->index();
    }
}
