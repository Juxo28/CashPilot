<?php

require_once __DIR__ . "/../models/rol.php";

class RolController
{
    public function index()
    {
        try {
            $rolModel = new Rol();
            $roles = $rolModel->getAll();

            require __DIR__ . "/../views/rol/index.php";
        } catch (PDOException $e) {
            mostrarError("los roles", $e);
        }
    }

    public function crear()
    {
        $errores = [];
        $old = [];
        require __DIR__ . "/../views/rol/crear.php";
    }

    public function guardar()
    {
        $old = [
            'nombre_rol'  => post('nombre_rol'),
            'descripcion' => post('descripcion'),
        ];
        $errores = [];

        if ($old['nombre_rol'] === '' || mb_strlen($old['nombre_rol']) > 40) {
            $errores[] = "El nombre del rol es obligatorio (máximo 40 caracteres).";
        }
        if (mb_strlen($old['descripcion']) > 255) {
            $errores[] = "La descripción no puede superar 255 caracteres.";
        }

        if (empty($errores)) {
            try {
                $rolModel = new Rol();
                $rolModel->create($old);
                redirigir('/rol?guardado=1');
            } catch (PDOException $e) {
                $errores[] = mensajeBD($e);
            }
        }

        require __DIR__ . "/../views/rol/crear.php";
    }
}
