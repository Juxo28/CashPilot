<?php

require_once __DIR__ . "/../app/controllers/empresaController.php";
require_once __DIR__ . "/../app/controllers/departamentoController.php";
require_once __DIR__ . "/../app/controllers/categoriaController.php";
require_once __DIR__ . "/../app/controllers/rolController.php";
require_once __DIR__ . "/../app/controllers/personaController.php";
require_once __DIR__ . "/../app/controllers/usuarioController.php";
require_once __DIR__ . "/../app/controllers/gastoController.php";
require_once __DIR__ . "/../app/controllers/ingresoController.php";
require_once __DIR__ . "/../app/controllers/homeController.php";


require_once __DIR__ . "/../config/helpers.php";

// Carpeta donde está instalado el proyecto, por ejemplo "/CashPilot/public".
// Si algún día lo publicas en la raíz de un dominio, queda vacío ("") y todo sigue funcionando.
define('BASE_PATH', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));

$rutas=require dirname(__DIR__) . "/rutas/web.php";
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$ruta = parse_url($uri, PHP_URL_PATH);

// Se le quita la carpeta del proyecto a la ruta: "/CashPilot/public/categoria" -> "/categoria"
if (BASE_PATH !== '' && stripos($ruta, BASE_PATH) === 0) {
    $ruta = substr($ruta, strlen(BASE_PATH));
}
$ruta = '/' . trim($ruta, '/');

$enrutamiento = $rutas[$method][$ruta] ?? null;

if ($enrutamiento !== null && str_starts_with($ruta, "/api/")){
    $controlador = new $enrutamiento[0]();
    $controlador->{$enrutamiento[1]}();
    exit;
}
// Si la ruta no existe, se avisa al navegador ANTES de imprimir cualquier HTML
if ($enrutamiento === null && $ruta !== "/") {
    http_response_code(404);
}

// Se "atrapa" lo que imprima el controlador, en vez de mandarlo directo al navegador
ob_start();

if ($enrutamiento !== null) {
    $nombreControlador = $enrutamiento[0];
    $nombreMetodo = $enrutamiento[1];

    $controlador = new $nombreControlador();
    $controlador->$nombreMetodo();
} elseif ($ruta !== "/") {
    echo "<h1>Página no encontrada</h1>";
    echo "<p>La ruta " . htmlspecialchars($ruta) . " no existe.</p>";
}

$contenido = ob_get_clean();

// El home es el diseño principal: mete el contenido dentro de la plantilla
$home = new homeController();
$home->index($contenido);
