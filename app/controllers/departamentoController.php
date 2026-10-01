<?php

require_once __DIR__ . "/../models/departamento.php";

class departamentoController
{
    public function index()
    {
        try {
            $departamento = new Departamento();

            $departamentos = $departamento->getAll();

            $departamentoConsultado = $departamento->getById("0 or 1=1");

            require_once __DIR__ . "/../views/departamento/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de departamento";
        }
    }

     public function crear(){
        require_once __DIR__ . "/../views/departamento/crear.php";
    }

    public function guardar()
    {
        $id_empresa = 1;
        $nombre_departamento = $_POST['nombre_departamento'];
        $descripcion = $_POST['descripcion'];
        $presupuesto = $_POST['presupuesto'];

        $departamento = new Departamento();
        $resultado = $departamento->guardar($id_empresa, $nombre_departamento, $descripcion, $presupuesto);

        if ($resultado) {
            echo "Departamento guardada conrrectamente";
            $this->index();
        } else {
            echo "No se pudo guardar la informacion";
        }
    }
}
