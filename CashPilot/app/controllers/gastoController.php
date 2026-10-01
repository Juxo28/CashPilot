<?php

require_once __DIR__ . "/../models/gasto.php";
require_once __DIR__ . "/../models/categoria.php";
require_once __DIR__ . "/../models/departamento.php";

class gastoController {

    public function index(){
        try {
            $gasto = new Gasto();
            $gastos = $gasto->getAll();

            require_once __DIR__ . "/../views/gasto/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de gasto";
        }
    }

    public function crear(){
        try {
            $categoriaModel = new Categoria();
            $departamentoModel = new Departamento();

            $categorias = $categoriaModel->getAll();
            $departamentos = $departamentoModel->getAll();

            require_once __DIR__ . "/../views/gasto/crear.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de gasto al mostrar el formulario";
        }
    }

    public function guardar(){
        try {
            $id_empresa = 1;
            $id_usuario = 1; // por ahora fijo, hasta que exista el login
            $id_departamento = $_GET['id_departamento'];
            $id_categoria = $_GET['id_categoria'];
            $monto = $_GET['monto'];
            $fecha = $_GET['fecha'];
            $descripcion = $_GET['descripcion'];
            $metodo_pago = $_GET['metodo_pago'];
            $comprobante = $_GET['comprobante'];

            if ($id_departamento == "" || $id_categoria == "" || !is_numeric($monto) || $monto <= 0 || $fecha == "" || $descripcion == "") {
                echo "Revisa los datos: departamento, categoria, monto (mayor que 0), fecha y descripcion son obligatorios";
                $categoriaModel = new Categoria();
                $departamentoModel = new Departamento();
                $categorias = $categoriaModel->getAll();
                $departamentos = $departamentoModel->getAll();
                require_once __DIR__ . "/../views/gasto/crear.php";
                return;
            }

            $gasto = new Gasto();
            $resultado = $gasto->create($id_empresa, $id_usuario, $id_departamento, $id_categoria, $monto, $fecha, $descripcion, $metodo_pago, $comprobante);

            if ($resultado) {
                header("Location: /gasto");
            } else {
                echo "No se pudo guardar. Revisa los datos e intenta de nuevo.";
                $categoriaModel = new Categoria();
                $departamentoModel = new Departamento();
                $categorias = $categoriaModel->getAll();
                $departamentos = $departamentoModel->getAll();
                require_once __DIR__ . "/../views/gasto/crear.php";
            }
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de gasto al guardar";
        }
    }
}
