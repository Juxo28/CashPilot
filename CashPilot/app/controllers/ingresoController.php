<?php

require_once __DIR__ . "/../models/ingreso.php";
require_once __DIR__ . "/../models/categoria.php";

class IngresoController
{
    public function index()
    {
        try {
            $ingresoModel = new Ingreso();
            $ingresos = $ingresoModel->getAllByEmpresa(ID_EMPRESA_ACTUAL);

            require __DIR__ . "/../views/ingreso/index.php";
        } catch (PDOException $e) {
            mostrarError("los ingresos", $e);
        }
    }

    public function crear()
    {
        $errores = [];
        $old = ['fecha' => date('Y-m-d')];
        $categorias = [];

        try {
            $categoriaModel = new Categoria();
            $categorias = $categoriaModel->getByTipo(ID_EMPRESA_ACTUAL, 'ingreso');
        } catch (PDOException $e) {
            $errores[] = mensajeBD($e);
        }

        require __DIR__ . "/../views/ingreso/crear.php";
    }

    public function guardar()
    {
        $old = [
            'id_categoria' => post('id_categoria'),
            'monto'        => post('monto'),
            'fecha'        => post('fecha'),
            'descripcion'  => post('descripcion'),
            'fuente'       => post('fuente'),
        ];
        $errores = [];
        $categorias = [];

        try {
            $categoriaModel = new Categoria();
            $categorias = $categoriaModel->getByTipo(ID_EMPRESA_ACTUAL, 'ingreso');
            $idsCategorias = array_map('strval', array_column($categorias, 'id_categoria'));

            if (!in_array($old['id_categoria'], $idsCategorias, true)) {
                $errores[] = "Elige una categoría de ingreso de la lista.";
            }
            if (!esMonto($old['monto']) || (float) $old['monto'] <= 0) {
                $errores[] = "El monto debe ser un número mayor que cero, sin puntos de miles (ejemplo: 5000000).";
            }
            if (!fechaValida($old['fecha'])) {
                $errores[] = "La fecha no es válida.";
            }
            if ($old['descripcion'] === '' || mb_strlen($old['descripcion']) > 255) {
                $errores[] = "La descripción es obligatoria (máximo 255 caracteres).";
            }
            if (mb_strlen($old['fuente']) > 120) {
                $errores[] = "La fuente no puede superar 120 caracteres.";
            }

            if (empty($errores)) {
                $ingresoModel = new Ingreso();
                $ingresoModel->create(ID_EMPRESA_ACTUAL, ID_USUARIO_ACTUAL, $old);
                redirigir('/ingreso?guardado=1');
            }
        } catch (PDOException $e) {
            $errores[] = mensajeBD($e);
        }

        require __DIR__ . "/../views/ingreso/crear.php";
    }
}
