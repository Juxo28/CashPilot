<?php

require_once __DIR__ . "/../models/departamento.php";

class departamentoController
{
    public function index()
    {
        try {
            $departamento = new Departamento();
            $departamentos = $departamento->getAll();

            require_once __DIR__ . "/../views/departamento/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de departamento: " . $e->getMessage();
        }
    }

    public function crear()
    {
        require_once __DIR__ . "/../views/departamento/crear.php";
    }

    public function guardar()
    {
        $id_empresa = 1; // temporal, hasta que exista el login

        $nombre_departamento = $_POST['nombre_departamento'];
        $descripcion = $_POST['descripcion'];
        $presupuesto = $_POST['presupuesto'];

        $departamento = new Departamento();
        $resultado = $departamento->guardar($id_empresa, $nombre_departamento, $descripcion, $presupuesto);

        if ($resultado) {
            echo "<p>Departamento guardado correctamente</p>";
        } else {
            echo "<p>No se pudo guardar la informacion</p>";
        }

        $this->index();
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        $departamentoM = new Departamento();
        $departamento = $departamentoM->getByid($id);

        if (!$departamento) {
            echo "<p>El departamento no existe</p>";
            return $this->index();
        }

        require_once __DIR__ . "/../views/departamento/editar.php";
    }

    public function actualizar()
    {
        $id = $_POST['id_departamento'];
        $nombre = $_POST['nombre_departamento'];
        $descripcion = $_POST['descripcion'];
        $presupuesto = $_POST['presupuesto'];

        $departamento = new Departamento();
        if ($departamento->actualizar($id, $nombre, $descripcion, $presupuesto)) {
            echo "<p>Departamento actualizado correctamente</p>";
        }

        return $this->index();
    }

    public function eliminar()
    {
        $id = $_POST['id_departamento'];

        try {
            $departamento = new Departamento();
            $departamento->eliminar($id);
            echo "<p>Departamento eliminado correctamente</p>";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<p>No se puede eliminar el departamento porque tiene gastos asociados.</p>";
            } else {
                echo "<p>Ocurrió un error al intentar eliminar el departamento.</p>";
            }
        }

        return $this->index();
    }
}
