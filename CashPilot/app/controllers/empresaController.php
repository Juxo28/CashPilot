<?php

require_once __DIR__ . "/../models/empresa.php";

class EmpresaController
{
    // GET /empresa  ->  lista de empresas
    public function index()
    {
        try {
            $empresaModel = new Empresa();
            $empresas = $empresaModel->getAll();

            require __DIR__ . "/../views/empresa/index.php";
        } catch (PDOException $e) {
            mostrarError("las empresas", $e);
        }
    }

    // GET /empresa/crear  ->  formulario vacío
    public function crear()
    {
        $errores = [];
        $old = [];
        require __DIR__ . "/../views/empresa/crear.php";
    }

    // POST /empresa  ->  valida y guarda
    public function guardar()
    {
        // $old conserva lo que el usuario escribió para no obligarlo a escribirlo otra vez si hay error.
        $old = [
            'nombre_empresa' => post('nombre_empresa'),
            'nit'            => post('nit'),
            'direccion'      => post('direccion'),
            'telefono'       => post('telefono'),
            'correo'         => post('correo'),
        ];
        $errores = [];

        if ($old['nombre_empresa'] === '' || mb_strlen($old['nombre_empresa']) > 120) {
            $errores[] = "El nombre de la empresa es obligatorio (máximo 120 caracteres).";
        }
        if ($old['nit'] === '' || mb_strlen($old['nit']) > 20 || preg_match('/^[0-9.\-]+$/', $old['nit']) !== 1) {
            $errores[] = "El NIT es obligatorio y solo puede tener números, puntos y guiones (máximo 20 caracteres).";
        }
        if (mb_strlen($old['direccion']) > 200) {
            $errores[] = "La dirección no puede superar 200 caracteres.";
        }
        if (mb_strlen($old['telefono']) > 20 || preg_match('/^[0-9+\-\s]*$/', $old['telefono']) !== 1) {
            $errores[] = "El teléfono solo puede tener números, espacios, + y - (máximo 20 caracteres).";
        }
        if ($old['correo'] !== '' && (mb_strlen($old['correo']) > 120 || !filter_var($old['correo'], FILTER_VALIDATE_EMAIL))) {
            $errores[] = "El correo no tiene un formato válido.";
        }

        if (empty($errores)) {
            try {
                $empresaModel = new Empresa();
                $empresaModel->create($old);
                redirigir('/empresa?guardado=1');
            } catch (PDOException $e) {
                $errores[] = mensajeBD($e);
            }
        }

        // Si llegamos aquí hubo errores: se vuelve a mostrar el formulario con los datos y los mensajes.
        require __DIR__ . "/../views/empresa/crear.php";
    }
}
