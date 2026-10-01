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
        $nombre_empresa = $_POST['nombre_empresa'];
        $nit = $_POST['nit'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];

        $empresa = new Empresa();
        $resultado = $empresa->guardar($nombre_empresa, $nit, $direccion, $telefono, $correo);
        
        if ($resultado) {
            echo "Empresa guardada conrrectamente";
            $this->index();
        } else {
            echo "No se pudo guardar la informacion";
        } 
    }
}