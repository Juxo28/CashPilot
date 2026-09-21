<?php

require_once __DIR__ . "/../app/controllers/empresaController.php";
require_once __DIR__ . "/../app/controllers/departamentoController.php";
require_once __DIR__ . "/../app/controllers/categoriaController.php";


$empresa = new empresaController();
$empresa->index();

$departamento = new departamentoController();
$departamento->index();

$categoria = new categoriaController();
$categoria->index();