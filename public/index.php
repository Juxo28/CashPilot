<?php

require_once __DIR__ . "/../app/controllers/empresaController.php";
require_once __DIR__ . "/../app/controllers/departamentoController.php";
require_once __DIR__ . "/../app/controllers/categoriaController.php";



?>

<a href="/empresa">Empresa</a>
<a href="/departamento">Departamento</a>
<a href="/categoria">Categoria</a>

<?php

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];




if ($method === "GET" && $uri === "/empresa") {
    $controller = new EmpresaController();
    $controller->index();
}if ($method === "GET" && $uri === "/departamento") {
    $controller = new DepartamentoController();
    $controller->index();
} if ($method === "GET" && $uri === "/categoria") {
    $controller = new CategoriaController();
    $controller->index();
} 

// $empresa = new empresaController();
//$empresa->index();

//$departamento = new departamentoController();
//$departamento->index();

//$categoria = new categoriaController();
//$categoria->index(); 