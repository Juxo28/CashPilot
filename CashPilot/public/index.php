<?php

require_once __DIR__ . "/../config/app.php";
require_once __DIR__ . "/../config/helpers.php";

require_once __DIR__ . "/../app/controllers/empresaController.php";
require_once __DIR__ . "/../app/controllers/departamentoController.php";
require_once __DIR__ . "/../app/controllers/categoriaController.php";
require_once __DIR__ . "/../app/controllers/rolController.php";
require_once __DIR__ . "/../app/controllers/personaController.php";
require_once __DIR__ . "/../app/controllers/usuarioController.php";
require_once __DIR__ . "/../app/controllers/gastoController.php";
require_once __DIR__ . "/../app/controllers/ingresoController.php";

// BASE_PATH = carpeta donde vive public/ dentro del servidor.
//   Sitio en la raíz (VirtualHost)  ->  ''
//   XAMPP en htdocs/CashPilot/public ->  '/CashPilot/public'
// Se calcula sola, así el proyecto funciona sin importar dónde lo instales.
define('BASE_PATH', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));

// Lista blanca de módulos: nombre en la URL => clase del controlador.
$modulos = [
    "empresa"      => "EmpresaController",
    "departamento" => "DepartamentoController",
    "categoria"    => "CategoriaController",
    "rol"          => "RolController",
    "persona"      => "PersonaController",
    "usuario"      => "UsuarioController",
    "gasto"        => "GastoController",
    "ingreso"      => "IngresoController",
];

// Cada módulo tiene 3 rutas: listar, mostrar el formulario y guardar.
$rutas = [];
foreach ($modulos as $nombre => $clase) {
    $rutas["GET /$nombre"]       = [$clase, "index"];
    $rutas["GET /$nombre/crear"] = [$clase, "crear"];
    $rutas["POST /$nombre"]      = [$clase, "guardar"];
}

// 1) ¿Qué pidió el navegador? Método (GET/POST) + ruta sin la carpeta base.
$metodo = $_SERVER['REQUEST_METHOD'];
$ruta = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);   // quita el ?guardado=1 y similares

if (BASE_PATH !== '' && strpos($ruta, BASE_PATH) === 0) {
    $ruta = substr($ruta, strlen(BASE_PATH));
}
$ruta = '/' . trim($ruta, '/');
if ($ruta === '/index.php') {
    $ruta = '/';
}

// 2) Se ejecuta el controlador DENTRO de un buffer: así, si hace una redirección (header),
//    todavía no se envió nada al navegador. Lo que "imprime" se guarda en $contenido.
ob_start();

if ($ruta === '/') {
    echo "<h1>CashPilot</h1><p>Elige un módulo en el menú.</p>";
} elseif (isset($rutas["$metodo $ruta"])) {
    [$clase, $accion] = $rutas["$metodo $ruta"];
    $controller = new $clase();
    $controller->$accion();
} else {
    http_response_code(404);
    echo "<h1>404</h1><p>Página no encontrada.</p>";
}

$contenido = ob_get_clean();

// 3) Se dibuja la página completa: menú + contenido del módulo.
require __DIR__ . "/../app/views/layout.php";
