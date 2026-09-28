<?php

require_once __DIR__ . "/../models/categoria.php";

class CategoriaController
{
    public function index()
    {
        try {
            $categoriaModel = new Categoria();
            $categorias = $categoriaModel->getAllByEmpresa(ID_EMPRESA_ACTUAL);

            require __DIR__ . "/../views/categoria/index.php";
        } catch (PDOException $e) {
            mostrarError("las categorías", $e);
        }
    }

    public function crear()
    {
        $errores = [];
        $old = [];
        require __DIR__ . "/../views/categoria/crear.php";
    }

    public function guardar()
    {
        $old = [
            'nombre_categoria' => post('nombre_categoria'),
            'tipo_categoria'   => post('tipo_categoria'),
            'descripcion'      => post('descripcion'),
        ];
        $errores = [];

        if ($old['nombre_categoria'] === '' || mb_strlen($old['nombre_categoria']) > 60) {
            $errores[] = "El nombre es obligatorio (máximo 60 caracteres).";
        }
        // in_array con true (estricto): el tipo debe ser EXACTAMENTE uno de los dos valores permitidos.
        if (!in_array($old['tipo_categoria'], ['ingreso', 'gasto'], true)) {
            $errores[] = "Elige un tipo válido: ingreso o gasto.";
        }
        if (mb_strlen($old['descripcion']) > 255) {
            $errores[] = "La descripción no puede superar 255 caracteres.";
        }

        if (empty($errores)) {
            try {
                $categoriaModel = new Categoria();
                $categoriaModel->create(ID_EMPRESA_ACTUAL, $old);
                redirigir('/categoria?guardado=1');
            } catch (PDOException $e) {
                $errores[] = mensajeBD($e);
            }
        }

        require __DIR__ . "/../views/categoria/crear.php";
    }
}
