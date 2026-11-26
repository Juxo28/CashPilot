<?php

require_once __DIR__ . "/../app/controllers/empresaController.php";
require_once __DIR__ . "/../app/controllers/departamentoController.php";
require_once __DIR__ . "/../app/controllers/categoriaController.php";
require_once __DIR__ . "/../app/controllers/rolController.php";
require_once __DIR__ . "/../app/controllers/personaController.php";
require_once __DIR__ . "/../app/controllers/usuarioController.php";
require_once __DIR__ . "/../app/controllers/gastoController.php";
require_once __DIR__ . "/../app/controllers/ingresoController.php";


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

// 1. Abre el HTML: <head>, menú y <main>
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CashPilot</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <!-- Tus estilos propios van DESPUÉS de Bootstrap, para poder sobrescribirlo -->
    <link rel="stylesheet" href="<?= url('/assets/css/app.css') ?>">
</head>
<body>

<!-- Menú principal: un solo lugar para todos los módulos -->
<nav class="navbar navbar-expand-lg bg-dark mb-4" data-bs-theme="dark">
    <div class="container">

        <!-- Logo / nombre: lleva al inicio -->
        <a class="navbar-brand fw-bold" href="<?= url('/') ?>">CashPilot</a>

        <!-- Botón ☰ que solo aparece en pantallas pequeñas -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
                aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Lo que se esconde/muestra con el botón ☰ -->
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= url('/empresa') ?>">Empresas</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/departamento') ?>">Departamentos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/categoria') ?>">Categorías</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/gasto') ?>">Gastos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/ingreso') ?>">Ingresos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/usuario') ?>">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/persona') ?>">Personas</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/rol') ?>">Roles</a></li>
            </ul>
        </div>

    </div>
</nav>



<main class="container">
<?php

// 2. El controlador imprime la vista dentro de <main>
if ($enrutamiento !== null) {
    $nombreControlador = $enrutamiento[0];
    $nombreMetodo = $enrutamiento[1];

    $controlador = new $nombreControlador();
    $controlador->$nombreMetodo();
} elseif ($ruta === "/") {
    echo "<h1>Bienvenido a CashPilot</h1>";
    echo "<p>Elige un módulo en el menú.</p>";
} else {
    echo "<h1>Página no encontrada</h1>";
    echo "<p>La ruta " . htmlspecialchars($ruta) . " no existe.</p>";
}

// 3. Cierra el HTML: </main>, scripts y </body>
?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
