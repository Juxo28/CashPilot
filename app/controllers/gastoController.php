<?php

require_once __DIR__ . "/../models/gasto.php";
require_once __DIR__ . "/../models/categoria.php";
require_once __DIR__ . "/../models/departamento.php";

class GastoController
{
    private $metodosPago = ['Efectivo', 'Tarjeta', 'Transferencia'];

    public function index()
    {
        try {
            $gastoModel = new Gasto();
            $gastos = $gastoModel->getAllByEmpresa(ID_EMPRESA_ACTUAL);

            require __DIR__ . "/../views/gasto/index.php";
        } catch (PDOException $e) {
            mostrarError("los gastos", $e);
        }
    }

    public function crear()
    {
        $errores = [];
        $old = ['fecha' => date('Y-m-d')];   // por defecto, la fecha de hoy
        $categorias = [];
        $departamentos = [];
        $metodosPago = $this->metodosPago;

        try {
            $categoriaModel = new Categoria();
            $departamentoModel = new Departamento();
            $categorias = $categoriaModel->getByTipo(ID_EMPRESA_ACTUAL, 'gasto');
            $departamentos = $departamentoModel->getAllByEmpresa(ID_EMPRESA_ACTUAL);
        } catch (PDOException $e) {
            $errores[] = mensajeBD($e);
        }

        require __DIR__ . "/../views/gasto/crear.php";
    }

    public function guardar()
    {
        $old = [
            'id_departamento' => post('id_departamento'),
            'id_categoria'    => post('id_categoria'),
            'monto'           => post('monto'),
            'fecha'           => post('fecha'),
            'descripcion'     => post('descripcion'),
            'metodo_pago'     => post('metodo_pago'),
            'comprobante'     => post('comprobante'),
        ];
        $errores = [];
        $categorias = [];
        $departamentos = [];
        $metodosPago = $this->metodosPago;

        try {
            $categoriaModel = new Categoria();
            $departamentoModel = new Departamento();
            $categorias = $categoriaModel->getByTipo(ID_EMPRESA_ACTUAL, 'gasto');
            $departamentos = $departamentoModel->getAllByEmpresa(ID_EMPRESA_ACTUAL);

            $idsCategorias = array_map('strval', array_column($categorias, 'id_categoria'));
            $idsDepartamentos = array_map('strval', array_column($departamentos, 'id_departamento'));

            if (!in_array($old['id_departamento'], $idsDepartamentos, true)) {
                $errores[] = "Elige un departamento de la lista.";
            }
            // Solo categorías de tipo 'gasto' de esta empresa: la base de datos no impide usar
            // una categoría de ingreso en un gasto, así que esta regla se valida aquí.
            if (!in_array($old['id_categoria'], $idsCategorias, true)) {
                $errores[] = "Elige una categoría de gasto de la lista.";
            }
            if (!esMonto($old['monto']) || (float) $old['monto'] <= 0) {
                $errores[] = "El monto debe ser un número mayor que cero, sin puntos de miles (ejemplo: 250000 o 250000.50).";
            }
            if (!fechaValida($old['fecha'])) {
                $errores[] = "La fecha no es válida.";
            }
            if ($old['descripcion'] === '' || mb_strlen($old['descripcion']) > 255) {
                $errores[] = "La descripción es obligatoria (máximo 255 caracteres).";
            }
            if (!in_array($old['metodo_pago'], $this->metodosPago, true)) {
                $errores[] = "Elige un método de pago válido.";
            }
            if (mb_strlen($old['comprobante']) > 150) {
                $errores[] = "El nombre del comprobante no puede superar 150 caracteres.";
            }

            if (empty($errores)) {
                $gastoModel = new Gasto();
                $gastoModel->create(ID_EMPRESA_ACTUAL, ID_USUARIO_ACTUAL, $old);
                redirigir('/gasto?guardado=1');
            }
        } catch (PDOException $e) {
            $errores[] = mensajeBD($e);
        }

        require __DIR__ . "/../views/gasto/crear.php";
    }
}
