<?php

require_once __DIR__ . "/../models/departamento.php";

class DepartamentoController
{
    public function index()
    {
        try {
            $departamentoModel = new Departamento();
            $departamentos = $departamentoModel->getAllByEmpresa(ID_EMPRESA_ACTUAL);

            require __DIR__ . "/../views/departamento/index.php";
        } catch (PDOException $e) {
            mostrarError("los departamentos", $e);
        }
    }

    public function crear()
    {
        $errores = [];
        $old = [];
        require __DIR__ . "/../views/departamento/crear.php";
    }

    public function guardar()
    {
        $old = [
            'nombre_departamento' => post('nombre_departamento'),
            'descripcion'         => post('descripcion'),
            'presupuesto'         => post('presupuesto'),
        ];
        $errores = [];

        if ($old['nombre_departamento'] === '' || mb_strlen($old['nombre_departamento']) > 80) {
            $errores[] = "El nombre es obligatorio (máximo 80 caracteres).";
        }
        if (mb_strlen($old['descripcion']) > 255) {
            $errores[] = "La descripción no puede superar 255 caracteres.";
        }
        // Presupuesto: opcional. Si viene vacío se guarda 0.
        if ($old['presupuesto'] === '') {
            $old['presupuesto'] = '0';
        } elseif (!esMonto($old['presupuesto'])) {
            $errores[] = "El presupuesto debe ser un número positivo, sin puntos de miles (ejemplo: 15000000 o 15000000.50).";
        }

        if (empty($errores)) {
            try {
                $departamentoModel = new Departamento();
                $departamentoModel->create(ID_EMPRESA_ACTUAL, $old);
                redirigir('/departamento?guardado=1');
            } catch (PDOException $e) {
                $errores[] = mensajeBD($e);
            }
        }

        require __DIR__ . "/../views/departamento/crear.php";
    }
}
