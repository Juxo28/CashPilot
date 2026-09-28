<?php

// Funciones independientes (no pertenecen a ninguna clase). Se usan en controladores y vistas.

// Escapa un valor para imprimirlo en HTML de forma segura. NULL se vuelve texto vacío.
function e($valor)
{
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}

// Construye una URL de la aplicación respetando la carpeta donde esté instalado el proyecto.
// Ejemplo: url('/empresa') -> '/CashPilot/public/empresa' (o '/empresa' si está en la raíz).
function url($ruta = '')
{
    return BASE_PATH . $ruta;
}

// Redirige a otra página de la aplicación y detiene el script.
function redirigir($ruta)
{
    header('Location: ' . url($ruta));
    exit;
}

// Lee un campo del formulario (POST) como texto sin espacios sobrantes. Si no llegó, devuelve ''.
function post($campo)
{
    return trim((string) ($_POST[$campo] ?? ''));
}

// ¿Es un monto válido? Solo dígitos y hasta 2 decimales con punto: 1500, 1500.5, 1500.50
function esMonto($valor)
{
    return preg_match('/^\d{1,13}(\.\d{1,2})?$/', $valor) === 1;
}

// ¿Es una fecha real en formato AAAA-MM-DD? (rechaza 2026-02-31)
function fechaValida($valor)
{
    $fecha = DateTime::createFromFormat('Y-m-d', $valor);
    return $fecha !== false && $fecha->format('Y-m-d') === $valor;
}

// Formatea dinero para mostrar: 8000000.00 -> $ 8.000.000
function dinero($valor)
{
    return '$ ' . number_format((float) $valor, 0, ',', '.');
}

// Convierte una excepción de la base de datos en un mensaje entendible para el usuario.
function mensajeBD(PDOException $e)
{
    $codigo = $e->errorInfo[1] ?? 0;

    if ($codigo === 1062) {
        return "Ya existe un registro con ese valor (un dato que debe ser único está repetido).";
    }
    if ($codigo === 1452) {
        return "Alguno de los datos relacionados no existe o pertenece a otra empresa.";
    }
    if ($codigo === 4025 || $codigo === 3819) {
        return "Algún valor no cumple las reglas de la base de datos (por ejemplo, el monto debe ser mayor que cero).";
    }

    $mensaje = "No fue posible guardar el registro.";
    if (defined('APP_DEBUG') && APP_DEBUG) {
        $mensaje .= " Detalle técnico: " . $e->getMessage();
    }
    return $mensaje;
}

// Muestra un error de forma uniforme en las páginas de listado.
// Con APP_DEBUG activo enseña el mensaje técnico real; en producción solo un mensaje genérico.
function mostrarError($contexto, Exception $e)
{
    echo "<p class='error'>No fue posible cargar " . e($contexto) . ".";
    if (defined('APP_DEBUG') && APP_DEBUG) {
        echo " Detalle técnico: " . e($e->getMessage());
    }
    echo "</p>";
}
