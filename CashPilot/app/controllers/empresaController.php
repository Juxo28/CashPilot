<?php

require_once __DIR__ . "/../models/empresa.php";

class empresaController {

    public function index(){
        try {
            $empresa = new Empresa();
            $empresas = $empresa->getAll();

            require_once __DIR__ . "/../views/empresa/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de empresa";
        }
    }

    public function crear(){
        require_once __DIR__ . "/../views/empresa/crear.php";
    }

    public function guardar(){
        try {
            $nombre_empresa = $_POST['nombre_empresa'];
            $nit = $_POST['nit'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];

            if ($nombre_empresa == "" || $nit == "") {
                echo "El nombre y el NIT son obligatorios";
                require_once __DIR__ . "/../views/empresa/crear.php";
                return;
            }

            $empresa = new Empresa();
            $resultado = $empresa->create($nombre_empresa, $nit, $direccion, $telefono, $correo);

            if ($resultado) {
                header("Location: /empresa");
            } else {
                echo "No se pudo guardar. Revisa los datos e intenta de nuevo.";
                require_once __DIR__ . "/../views/empresa/crear.php";
            }
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de empresa al guardar";
        }
    }
}
