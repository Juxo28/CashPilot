<?php

require_once __DIR__ . "/../app/controllers/empresaController.php";
require_once __DIR__ . "/../app/controllers/departamentoController.php";
require_once __DIR__ . "/../app/controllers/categoriaController.php";
require_once __DIR__ . "/../app/controllers/rolController.php";
require_once __DIR__ . "/../app/controllers/personaController.php";
require_once __DIR__ . "/../app/controllers/usuarioController.php";
require_once __DIR__ . "/../app/controllers/gastoController.php";
require_once __DIR__ . "/../app/controllers/ingresoController.php";


$rutas=require dirname(__DIR__) . "/rutas/web.php";
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$ruta = parse_url($uri, PHP_URL_PATH);

?>

<a href="/empresa">Empresa</a>
<a href="/empresa/crear">Crear Empresa Nueva</a>
<a href="/categoria">Categoria</a>
<a href="/departamento">Departamento</a>


<?php 

$enrutamiento = $rutas[$method][$ruta] ?? null; 

if ($enrutamiento !== null){
    $nombreControlador = $enrutamiento[0];
    $nombreMetodo = $enrutamiento[1];

    $controlador = new $nombreControlador();
    $controlador->$nombreMetodo();
}