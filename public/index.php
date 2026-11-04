<?php
// Con "php -S" los archivos que existen (CSS, JS) se sirven tal cual. En Apache lo hace .htaccess.
if (PHP_SAPI === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../app/controllers/authController.php";
require_once __DIR__ . "/../app/controllers/empresaController.php";
require_once __DIR__ . "/../app/controllers/departamentoController.php";
require_once __DIR__ . "/../app/controllers/categoriaController.php";
require_once __DIR__ . "/../app/controllers/rolController.php";
require_once __DIR__ . "/../app/controllers/personaController.php";
require_once __DIR__ . "/../app/controllers/usuarioController.php";
require_once __DIR__ . "/../app/controllers/gastoController.php";
require_once __DIR__ . "/../app/controllers/ingresoController.php";

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$ruta = parse_url($uri, PHP_URL_PATH);

// ---- Rutas públicas: no necesitan sesión ----
if ($method === "GET" && $ruta === "/login") {
    $controller = new authController();
    $controller->login();
    exit;
}
if ($method === "GET" && $ruta === "/logout") {
    $controller = new authController();
    $controller->logout();
    exit;
}

// ---- Desde aquí todo está protegido ----
// Sin un token de Supabase válido no se ejecuta ningún controlador (ni escribiendo la URL a mano).
$usuarioActual = auth_requerir();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashPilot</title>
    <link rel="stylesheet" href="/estilos.css">
</head>
<body>
<nav>
    <strong>CashPilot</strong>
    <a href="/empresa">Empresa</a>
    <a href="/departamento">Departamento</a>
    <a href="/categoria">Categoria</a>
    <a href="/rol">Rol</a>
    <a href="/persona">Persona</a>
    <a href="/usuario">Usuario</a>
    <a href="/gasto">Gasto</a>
    <a href="/ingreso">Ingreso</a>
    <span class="nav-usuario">
        <span data-user-email><?= htmlspecialchars($usuarioActual['email'], ENT_QUOTES, 'UTF-8') ?></span>
        <button type="button" id="btn-logout">Cerrar sesión</button>
    </span>
</nav>
<main>

<?php if ($ruta === "/"): ?>
    <h1>Bienvenido a CashPilot</h1>
    <p>Selecciona un módulo en el menú.</p>
<?php endif; ?>

<?php

if ($ruta === "/empresa/editar" && $method === "GET") {
    $controller = new empresaController();
    $controller->editar();
}
if ($method === "GET" && $uri === "/empresa") {
    $controller = new empresaController();
    $controller->index();
} if ($method === "GET" && $uri === "/empresa/crear") {
    $controller = new empresaController();
    $controller->crear();
} if ($method === "POST" && $uri === "/empresa") {
    $controller = new empresaController();
    $controller->guardar();
} if ($method === "POST" && $ruta === "/empresa/editar"){
    $controller = new empresaController();
    $controller->actualizar();
} if ($method === "POST" && $ruta === "/empresa/eliminar"){
    $controller = new empresaController();
    $controller->eliminar();
}

if ($method === "GET" && $uri === "/departamento") {
    $controller = new departamentoController();
    $controller->index();
} if ($method === "GET" && $uri === "/departamento/crear") {
    $controller = new departamentoController();
    $controller->crear();
}
if ($method === "POST" && $uri === "/departamento") {
    $controller = new departamentoController();
    $controller->guardar();
}


if ($method === "GET" && $uri === "/categoria") {
    $controller = new categoriaController();
    $controller->index();
} if ($method === "GET" && $uri === "/categoria/crear") {
    $controller = new categoriaController();
    $controller->crear();
} if ($method === "POST" && $uri === "/categoria/guardar") {
    $controller = new categoriaController();
    $controller->guardar();
}

if ($method === "GET" && $uri === "/rol") {
    $controller = new rolController();
    $controller->index();
} if ($method === "GET" && $uri === "/rol/crear") {
    $controller = new rolController();
    $controller->crear();
}

if ($method === "GET" && $uri === "/persona") {
    $controller = new personaController();
    $controller->index();
} if ($method === "GET" && $uri === "/persona/crear") {
    $controller = new personaController();
    $controller->crear();
}

if ($method === "GET" && $uri === "/usuario") {
    $controller = new usuarioController();
    $controller->index();
} if ($method === "GET" && $uri === "/usuario/crear") {
    $controller = new usuarioController();
    $controller->crear();
}

if ($method === "GET" && $uri === "/gasto") {
    $controller = new gastoController();
    $controller->index();
} if ($method === "GET" && $uri === "/gasto/crear") {
    $controller = new gastoController();
    $controller->crear();
}

if ($method === "GET" && $uri === "/ingreso") {
    $controller = new ingresoController();
    $controller->index();
} if ($method === "GET" && $uri === "/ingreso/crear") {
    $controller = new ingresoController();
    $controller->crear();
}



if ($method === "GET" && $uri === "/departamento") {
    $controller = new departamentoController();
    $controller->index();
} if ($method === "GET" && $uri === "/departamento/crear") {
    $controller = new departamentoController();
    $controller->crear();
}
if ($method === "POST" && $uri === "/departamento") {
    $controller = new departamentoController();
    $controller->guardar();
}
?>

</main>
<script src="/assets/js/auth/config.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2.45.4/dist/umd/supabase.js"></script>
<script src="/assets/js/auth/supabase-client.js"></script>
<script src="/assets/js/auth/guard.js"></script>
</body>
</html>
