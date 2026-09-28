<?php

require_once __DIR__ . "/../models/departamento.php";

class departamentoController {

    public function index(){
        try {
            $departamento = new Departamento();
            $departamentos = $departamento->getAll();

            require_once __DIR__ . "/../views/departamento/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de departamento";
        }
    }

    public function crear(){
        require_once __DIR__ . "/../views/departamento/crear.php";
    }

    public function guardar(){
        try {
            $id_empresa = 1;
            $nombre_departamento = $_POST['nombre_departamento'];
            $descripcion = $_POST['descripcion'];
            $presupuesto = $_POST['presupuesto'];

            if ($nombre_departamento == "" || !is_numeric($presupuesto)) {
                echo "El nombre es obligatorio y el presupuesto debe ser un numero";
                require_once __DIR__ . "/../views/departamento/crear.php";
                return;
            }

            $departamento = new Departamento();
            $resultado = $departamento->create($id_empresa, $nombre_departamento, $descripcion, $presupuesto);

            if ($resultado) {
                header("Location: /departamento");
            } else {
                echo "No se pudo guardar. Revisa los datos e intenta de nuevo.";
                require_once __DIR__ . "/../views/departamento/crear.php";
            }
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de departamento al guardar";
        }
    }
}
