<?php

require_once __DIR__ . "/../models/ingreso.php";
require_once __DIR__ . "/../models/categoria.php";

class ingresoController {

    public function index(){
        try {
            $ingreso = new Ingreso();
            $ingresos = $ingreso->getAll();

            require_once __DIR__ . "/../views/ingreso/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de ingreso";
        }
    }

    public function crear(){
        try {
            $categoriaModel = new Categoria();
            $categorias = $categoriaModel->getAll();

            require_once __DIR__ . "/../views/ingreso/crear.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de ingreso al mostrar el formulario";
        }
    }

    public function guardar(){
        try {
            $id_empresa = 1;
            $id_usuario = 1;
            $id_categoria = $_GET['id_categoria'];
            $monto = $_GET['monto'];
            $fecha = $_GET['fecha'];
            $descripcion = $_GET['descripcion'];
            $fuente = $_GET['fuente'];

            if ($id_categoria == "" || !is_numeric($monto) || $monto <= 0 || $fecha == "" || $descripcion == "") {
                echo "Revisa los datos: categoria, monto (mayor que 0), fecha y descripcion son obligatorios";
                $categoriaModel = new Categoria();
                $categorias = $categoriaModel->getAll();
                require_once __DIR__ . "/../views/ingreso/crear.php";
                return;
            }

            $ingreso = new Ingreso();
            $resultado = $ingreso->create($id_empresa, $id_usuario, $id_categoria, $monto, $fecha, $descripcion, $fuente);

            if ($resultado) {
                header("Location: /ingreso");
            } else {
                echo "No se pudo guardar. Revisa los datos e intenta de nuevo.";
                $categoriaModel = new Categoria();
                $categorias = $categoriaModel->getAll();
                require_once __DIR__ . "/../views/ingreso/crear.php";
            }
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de ingreso al guardar";
        }
    }
}
