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
</nav>

<main>

<?php

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$ruta = parse_url($uri,PHP_URL_PATH);

switch ($ruta) {
    case "/empresa/editar":
        if ($method === "GET"){
        $controller = new empresaController();
        $controller->editar();
        } elseif ($method === "POST") {
            $controller = new empresaController();
        $controller->actualizar();
            echo "Empresa Actualizada";
        } 
        break;
    case "/empresa":
        if ($method === "GET"){
         $controller = new empresaController();
         $controller->index();
            echo "";
        } elseif ($method === "POST"){
              $controller = new empresaController();
        $controller->guardar();
            echo "Empresa Guardada";
        }

        break;
    case "/empresa/crear":
        if ($method === "GET"){
        $controller = new empresaController();
        $controller->crear();
            echo "";
        }
        break;
    case "/empresa/eliminar":
    if ($method === "POST"){
         $controller = new empresaController();
    $controller->eliminar();
        echo "";
    }
    break;
     case "/categoria":
        if ($method === "GET"){
         $controller = new categoriaController();
         $controller->index();
            echo "";
        }
        break;
        case "/categoria/guardar":
        if ($method === "POST"){
              $controller = new categoriaController();
        $controller->guardar();
            echo "Categoria Guardada";
        }
        break;
    case "/categoria/editar":
        if ($method === "GET"){
        $controller = new categoriaController();
        $controller->editar();
        } elseif ($method === "POST") {
            $controller = new categoriaController();
        $controller->actualizar();
            echo "categoria Actualizada";
        } 
        break;
   
    case "/categoria/crear":
        if ($method === "GET"){
        $controller = new categoriaController();
        $controller->crear();
            echo "";
        }
        break;
    case "/categoria/eliminar":
    if ($method === "POST"){
         $controller = new categoriaController();
    $controller->eliminar();
        echo "";
    }
    break;
     case "/rol":
        if ($method === "GET"){
         $controller = new rolController();
         $controller->index();
            echo "";
        } elseif ($method === "POST"){
              $controller = new rolController();
        $controller->guardar();
            echo "rol guardado";
        }

        break;
    case "/rol/editar":
        if ($method === "GET"){
        $controller = new rolController();
        $controller->editar();
        } elseif ($method === "POST") {
            $controller = new rolController();
        $controller->actualizar();
            echo "Rol Actualizado";
        } 
        break;
   
    case "/rol/crear":
        if ($method === "GET"){
        $controller = new rolController();
        $controller->crear();
            echo "";
        }
        break;
    case "/rol/eliminar":
    if ($method === "POST"){
         $controller = new rolController();
    $controller->eliminar();
        echo "";
    }
    break;
     case "/persona":
        if ($method === "GET"){
         $controller = new personaController();
         $controller->index();
            echo "";
        } elseif ($method === "POST"){
              $controller = new personaController();
        $controller->guardar();
            echo "persona Guardada";
        }

        break;
    case "/persona/editar":
        if ($method === "GET"){
        $controller = new personaController();
        $controller->editar();
        } elseif ($method === "POST") {
            $controller = new personaController();
        $controller->actualizar();
            echo "persona Actualizada";
        } 
        break;
   
    case "/persona/crear":
        if ($method === "GET"){
        $controller = new personaController();
        $controller->crear();
            echo "";
        }
        break;
    case "/persona/eliminar":
    if ($method === "POST"){
         $controller = new personaController();
    $controller->eliminar();
        echo "";
    }
    break;
    
     case "/usuario":
        if ($method === "GET"){
         $controller = new usuarioController();
         $controller->index();
            echo "";
        } elseif ($method === "POST"){
              $controller = new usuarioController();
        $controller->guardar();
            echo "usuario Guardada";
        }

        break;
    case "/usuario/editar":
        if ($method === "GET"){
        $controller = new usuarioController();
        $controller->editar();
        } elseif ($method === "POST") {
            $controller = new usuarioController();
        $controller->actualizar();
            echo "usuario Actualizada";
        } 
        break;
   
    case "/usuario/crear":
        if ($method === "GET"){
        $controller = new usuarioController();
        $controller->crear();
            echo "";
        }
        break;
    case "/usuario/eliminar":
    if ($method === "POST"){
         $controller = new usuarioController();
    $controller->eliminar();
        echo "";
    }
    break;

     case "/gasto":
        if ($method === "GET"){
         $controller = new gastoController();
         $controller->index();
            echo "";
        } elseif ($method === "POST"){
              $controller = new gastoController();
        $controller->guardar();
            echo "gasto Guardada";
        }

        break;
    case "/gasto/editar":
        if ($method === "GET"){
        $controller = new gastoController();
        $controller->editar();
        } elseif ($method === "POST") {
            $controller = new gastoController();
        $controller->actualizar();
            echo "gasto Actualizada";
        } 
        break;
   
    case "/gasto/crear":
        if ($method === "GET"){
        $controller = new gastoController();
        $controller->crear();
            echo "";
        }
        break;
    case "/gasto/eliminar":
    if ($method === "POST"){
         $controller = new gastoController();
    $controller->eliminar();
        echo "";
    }
    break;
    
     case "/ingreso":
        if ($method === "GET"){
         $controller = new ingresoController();
         $controller->index();
            echo "";
        } elseif ($method === "POST"){
              $controller = new ingresoController();
        $controller->guardar();
            echo "ingreso Guardada";
        }

        break;
    case "/ingreso/editar":
        if ($method === "GET"){
        $controller = new ingresoController();
        $controller->editar();
        } elseif ($method === "POST") {
            $controller = new ingresoController();
        $controller->actualizar();
            echo "ingreso Actualizada";
        } 
        break;
   
    case "/ingreso/crear":
        if ($method === "GET"){
        $controller = new ingresoController();
        $controller->crear();
            echo "";
        }
        break;
    case "/ingreso/eliminar":
    if ($method === "POST"){
         $controller = new ingresoController();
    $controller->eliminar();
        echo "";
    }
    break;
   
     case "/departamento":
        if ($method === "GET"){
         $controller = new departamentoController();
         $controller->index();
            echo "";
        } elseif ($method === "POST"){
              $controller = new departamentoController();
        $controller->guardar();
            echo "departamento Guardada";
        }

        break;
    case "/departamento/editar":
        if ($method === "GET"){
        $controller = new departamentoController();
        $controller->editar();
        } elseif ($method === "POST") {
            $controller = new departamentoController();
        $controller->actualizar();
            echo "departamento Actualizada";
        } 
        break;
   
    case "/departamento/crear":
        if ($method === "GET"){
        $controller = new departamentoController();
        $controller->crear();
            echo "";
        }
        break;
    case "/departamento/eliminar":
    if ($method === "POST"){
         $controller = new departamentoController();
    $controller->eliminar();
        echo "";
    }
    break;
    default:
    echo "Ruta no encontrada";
}


?>
</main>
</body>
</html>
