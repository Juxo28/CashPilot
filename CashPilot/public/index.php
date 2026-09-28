<?php

require_once __DIR__ . "/../app/controllers/empresaController.php";
require_once __DIR__ . "/../app/controllers/departamentoController.php";
require_once __DIR__ . "/../app/controllers/categoriaController.php";
require_once __DIR__ . "/../app/controllers/rolController.php";
require_once __DIR__ . "/../app/controllers/personaController.php";
require_once __DIR__ . "/../app/controllers/usuarioController.php";
require_once __DIR__ . "/../app/controllers/gastoController.php";
require_once __DIR__ . "/../app/controllers/ingresoController.php";

?>

<a href="/empresa">Empresa</a> |
<a href="/departamento">Departamento</a> |
<a href="/categoria">Categoria</a> |
<a href="/rol">Rol</a> |
<a href="/persona">Persona</a> |
<a href="/usuario">Usuario</a> |
<a href="/gasto">Gasto</a> |
<a href="/ingreso">Ingreso</a>
<hr>

<?php

$method = $_SERVER['REQUEST_METHOD'];

// OJO: aquí estaba el bug. $uri tiene que leer REQUEST_URI, no REQUEST_METHOD otra vez.
// parse_url() le quita el ?algo=valor si lo llegara a tener, para que la comparación sea exacta.
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($method === "GET" && $uri === "/empresa") {
    $controller = new empresaController();
    $controller->index();
} if ($method === "GET" && $uri === "/empresa/crear") {
    $controller = new empresaController();
    $controller->crear();
} if ($method === "POST" && $uri === "/empresa") {
    $controller = new empresaController();
    $controller->guardar();
}

if ($method === "GET" && $uri === "/departamento") {
    $controller = new departamentoController();
    $controller->index();
} if ($method === "GET" && $uri === "/departamento/crear") {
    $controller = new departamentoController();
    $controller->crear();
} if ($method === "POST" && $uri === "/departamento") {
    $controller = new departamentoController();
    $controller->guardar();
}

if ($method === "GET" && $uri === "/categoria") {
    $controller = new categoriaController();
    $controller->index();
} if ($method === "GET" && $uri === "/categoria/crear") {
    $controller = new categoriaController();
    $controller->crear();
} if ($method === "POST" && $uri === "/categoria") {
    $controller = new categoriaController();
    $controller->guardar();
}

if ($method === "GET" && $uri === "/rol") {
    $controller = new rolController();
    $controller->index();
} if ($method === "GET" && $uri === "/rol/crear") {
    $controller = new rolController();
    $controller->crear();
} if ($method === "POST" && $uri === "/rol") {
    $controller = new rolController();
    $controller->guardar();
}

if ($method === "GET" && $uri === "/persona") {
    $controller = new personaController();
    $controller->index();
} if ($method === "GET" && $uri === "/persona/crear") {
    $controller = new personaController();
    $controller->crear();
} if ($method === "POST" && $uri === "/persona") {
    $controller = new personaController();
    $controller->guardar();
}

if ($method === "GET" && $uri === "/usuario") {
    $controller = new usuarioController();
    $controller->index();
} if ($method === "GET" && $uri === "/usuario/crear") {
    $controller = new usuarioController();
    $controller->crear();
} if ($method === "POST" && $uri === "/usuario") {
    $controller = new usuarioController();
    $controller->guardar();
}

if ($method === "GET" && $uri === "/gasto") {
    $controller = new gastoController();
    $controller->index();
} if ($method === "GET" && $uri === "/gasto/crear") {
    $controller = new gastoController();
    $controller->crear();
} if ($method === "POST" && $uri === "/gasto") {
    $controller = new gastoController();
    $controller->guardar();
}

if ($method === "GET" && $uri === "/ingreso") {
    $controller = new ingresoController();
    $controller->index();
} if ($method === "GET" && $uri === "/ingreso/crear") {
    $controller = new ingresoController();
    $controller->crear();
} if ($method === "POST" && $uri === "/ingreso") {
    $controller = new ingresoController();
    $controller->guardar();
}
