<?php

require_once __DIR__ . "/../models/empresa.php";

class empresaController
{
    public function index()
    {
        try {
            $empresa = new Empresa();
            $empresas = $empresa->getAll();

            require_once __DIR__ . "/../views/empresa/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de empresa";
        }
    }

    public function crear()
    {
        require_once __DIR__ . "/../views/empresa/crear.php";
    }

    public function guardar()
    {
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

    public function editar()
    {

        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $empresaM = new Empresa();
        $empresa = $empresaM->getByid($id);

        require_once __DIR__ . "/../views/empresa/editar.php";
    }

    public function actualizar()
    {
        $id = $_POST['id_empresa'];
        $nombre_empresa = $_POST['nombre_empresa'];
        $nit = $_POST['nit'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];

        $empresa = new Empresa();
        $empresa->actualizar($id, $nombre_empresa, $nit, $direccion, $telefono, $correo);

        return $this->index();
    }

    public function eliminar()
{
    $id = $_POST['id_empresa'];

    try {
        $empresa = new Empresa();
        $empresa->eliminar($id);
        echo "Empresa eliminada correctamente";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "No se puede eliminar la empresa porque tiene registros asociados (departamentos, usuarios, gastos, etc.).";
        } else {
            echo "Ocurrió un error al intentar eliminar la empresa.";
        }
    }

    return $this->index();
}
}
