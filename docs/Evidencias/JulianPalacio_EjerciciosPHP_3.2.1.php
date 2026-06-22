<?php
/* ==========================================
PARTE 1 — ANÁLISIS DE SITUACIONES PROBLEMA
========================================== */
echo "<h1>PARTE 1 — ANÁLISIS DE SITUACIONES PROBLEMA </h1>";

/* ==========================================
EJERCICIO 1
Calcular el promedio de tres notas
========================================== */
echo "<b>EJERCICIO 1 </b> <br>";


$nota1 = 4.5;
$nota2 = 5.0;
$nota3 = 2.8;


$total = $nota1 + $nota2 + $nota3;


$promedio = $total / 3;


echo "El promedio de las notas " . $nota1 . ", " . $nota2 . ", " . $nota3 . " es igual a " . number_format($promedio);

echo "<br><br>";

/* ==========================================
EJERCICIO 2
Validar préstamo de libros
========================================== */
echo "<b>EJERCICIO 2 </b> <br>";


$usuario = "Julian";
$librosPrestados = 3;
$limiteLibros = 5;


if ($librosPrestados < $limiteLibros) {
    $mensaje = "El usuario $usuario puede realizar un nuevo préstamo.";
} else {
    $mensaje = "El usuario $usuario NO puede realizar un nuevo préstamo.";
}


echo $mensaje;
echo "<br><br>";

/* ==========================================
EJERCICIO 3
Validar disponibilidad de producto
========================================== */
echo "<b>EJERCICIO 3 </b> <br>";


$producto = "Teclado Gamer";
$cantidadDisponible = 5;


if ($cantidadDisponible > 0) {
    $mensaje = "Hay disponible";
} else {
    $mensaje = "No hay disponible";
}


echo $mensaje;
echo "<br><br>";

/* ==========================================
EJERCICIO 4
Calcular consumo de una mesa
========================================== */
echo "<b>EJERCICIO 4 </b><br>";


$mesa = 5;
$mojarra = 35000;
$postre = 20000;
$bedidas = 22500;


echo "La mesa " . $mesa . " selecciono los siguientes platos: Mojarra, Coca Cola, CheeseCake";

echo "<br> <b>================ </b>";


echo "<br>Mojarra = " . $mojarra;
echo "<br>CheeseCake = " . $postre;
echo "<br>Coca Cola = " . $bedidas;

echo "<br>El valor total de su consumo es de: " . $valortotal = ($mojarra + $postre + $bedidas);

echo "<br> <b>================ </b>";

echo "<hr>";

/* ==========================================
PARTE 2 — ORGANIZACIÓN DE SECUENCIAS LÓGICAS
========================================== */

echo "<h1>PARTE 2 — ORGANIZACIÓN DE SECUENCIAS LÓGICAS </h1>";

echo "<b>EJERCICIO 5</b><br><br>";

echo "Realizado en el cuaderno <br><br>";

echo "<b>EJERCICIO 6 </b><br><br>";

echo "Realizado en el cuaderno <br><br>";

echo "<b>EJERCICIO 7 </b><br><br>";

echo "Realizado en el cuaderno <br><br>";

echo "<b>EJERCICIO 8 </b><br> <br>";

echo "Realizado en el cuaderno";

echo "<hr>";

/* ==========================================
PARTE 3 — PRIMEROS EJERCICIOS EN PHP
========================================== */

echo "<h1>PARTE 3 — PRIMEROS EJERCICIOS EN PHP </h1>";

/* ==========================================
EJERCICIO 9 — MENSAJE PERSONAL
========================================== */
echo " <b> EJERCICIO 9 — MENSAJE PERSONAL </b>";


$nombre = "Julian";
$edad = 21;
$municipio = "La Dorada, Caldas";


echo "<br> Mi nombre es " . $nombre . " <br> Tengo " . $edad . " años <br> Vivo en " . $municipio;

/* ==========================================
EJERCICIO 10 — INFORMACIÓN ACADÉMICA
========================================== */
echo "<br><br> <b> EJERCICIO 10 — INFORMACIÓN ACADÉMICA </b> ";


$aprendiz = "Julian Palacio";
$programa = "ADSO";
$ficha = 3230905;


echo "<br> El aprendiz se llama: " . $aprendiz . " <br> Programa: " . $programa . " <br> Ficha: " . $ficha;

/* ==========================================
EJERCICIO 11 — VIDEOJUEGO
========================================== */
echo "<br><br>  <b> EJERCICIO 11 — VIDEOJUEGO  </b> ";


$personaje = "Kai";
$nivel = 30;
$vidas = 5;


echo "<br> Personaje:  " . $personaje . " <br> Nivel " . $nivel . " <br> " . $vidas . " vidas";

/* ==========================================
EJERCICIO 12 — PLANETAS
========================================== */
echo "<br><br> <b> EJERCICIO 12  — PLANETAS </b>";


$planeta = "Saturno";
$lunas = 274;
$temperatura = "-220 °F";

echo "<br> El planeta " . $planeta . " <br> Tiene " . $lunas . " lunas <br> Su temperatura es" . $temperatura;

/* ==========================================
EJERCICIO 13 — PRODUCTO
========================================== */
echo "<br><br> <b> EJERCICIO 13  — PRODUCTO </b> ";


$producto = "RTX 5090";
$precio = "$ 21.000.000";
$cantidad = 5;


echo "<br>" . $producto . "<br> Valor: " . $precio . " <br> Hay " . $cantidad . " disponibles";

/* ==========================================
EJERCICIO 14 — MASCOTA
========================================== */
echo "<br><br>  <b> EJERCICIO 14  — MASCOTA </b>";

$mascota = "Oddie";
$especie = "Canino";
$edad = 5;


echo "<br> Nombre de la mascota: " . $mascota, " <br> Especie: " . $especie . " <br> Edad " . $edad . " años";

/* ==========================================
EJERCICIO 15 — VEHÍCULO
========================================== */
echo "<br><br>  <b>EJERCICIO 15 — VEHÍCULO </b>";


$vehiculo = "Hunk 125R";
$modelo = 2026;
$velomax = "120KM/H";


echo "<br> El vehiculo " . $vehiculo . "<br> Modelo: " . $modelo . " <br> Alcanza una velocidad maxima de " . $velomax;

/* ==========================================
EJERCICIO 16 — PELÍCULA
========================================== */
echo "<br><br>  <b>EJERCICIO 16 — PELÍCULA </b>";

$pelicula = "Spiderman No Way Home";
$genero = "Ficcion y Accion";
$estreno = 2021;


echo "<br> Pelicula: " . $pelicula . " <br> Genero: " . $genero . " <br> Fecha de salida: " . $estreno;

/* ==========================================
EJERCICIO 17 — PERFIL DE RED SOCIAL
========================================== */
echo " <br><br> <b> Ejercicio 17 - PERFIL DE RED SOCIAL </b>";


$username = "Fernanfloo";
$seguidores = 50;
$ciudad = "El Salvador";

echo " <br> El influencer: " . $username . "<br> Tiene: " . $seguidores . " Millones de seguidores " . "<br> Vive en " . $ciudad;

/* ==========================================
EJERCICIO 18 — RETO LIBRE
========================================== */
echo "<br><br> <b> Ejercicio 18 - RETO LIBRE </b> ";


$pc = "HP";
$procesador = "Ryzen 5400U";
$ram = "12Gb";
$espacio = "237Gb";


echo "<br>  Especificaciones de PC" . "<br> Marca: " . $pc . "<br> Procesador: " . $procesador . " <br> Ram: " . $ram . "<br> Discoduro: " . $espacio;

/* ==========================================
RETO EXTRA
========================================== */
echo "<br><br> <b> RETO EXTRA </b> ";


$nombre = "Julian";
$edad = 21;
$municipio = "La Dorada, Caldas";


echo "<br> Hola  " . $nombre . " tienes " . $edad . " años  y vives en " . $municipio;

/* ==========================================
RETO EXTRA 2
========================================== */
echo "<br><br> <b> RETO EXTRA 2 </b> ";


$nombre = "Ana";


echo $nombre;

echo "<hr>";

/* ==========================================
PARTE 2 — OPERACIONES BÁSICAS EN PHP
========================================== */

echo "<h1> PARTE 2 — OPERACIONES BÁSICAS EN PHP </h1> ";

/* ==========================================
EJERCICIO 19 – SUMA DE DOS NÚMEROS
========================================== */


echo "<br> <b> EJERCICIO 19 – SUMA DE DOS NÚMEROS </b><br>";

$num1 = 5;

$num2 = 8;

$total = $num1 + $num2;


echo "La suma de " . $num1 . " y " . $num2 . " Es igual a = " . $total;


echo "<br><br>";

/* ==========================================
EJERCICIO  20 – PROMEDIO DE TRES NOTAS
========================================== */

echo " <br> <b>EJERCICIO  20 – PROMEDIO DE TRES NOTAS </b> <br>";

$nota1 = 4.5;
$nota2 = 5.0;
$nota3 = 2.8;

$total = $nota1 + $nota2 + $nota3;

$promedio = $total / 3;

echo "El promedio de las notas " . $nota1 . ", " . $nota2 . ", " . $nota3 . " es igual a " . number_format($promedio);

echo "<br><br>";


/* ==========================================
EJERCICIO 21 — CÁLCULO DE IVA
========================================== */

echo " <br> <b> EJERCICIO 21 — CÁLCULO DE IVA </b><br>";

$compra = 50000;
$iva = $compra * 0.19;
$totalFinal = $compra + $iva;

echo "Subtotal: " . $compra . "<br>";
echo "IVA (19%): " . $iva . "<br>";
echo "Total final: " . $totalFinal;
echo "<br><br>";

/* ==========================================
EJERCICIO 22 — CÁLCULO DE DESCUENTO
========================================== */

echo "<br><b>EJERCICIO 22 — CÁLCULO DE DESCUENTO</b><br>";


$valorProducto = 50000;


$descuento = 10;


$valorDescuento = ($valorProducto * $descuento) / 100;

$valorFinal = $valorProducto - $valorDescuento;

// Mostrar resultados
echo "Valor producto: " . $valorProducto;
echo "<br>Descuento: " . $descuento . "%";
echo "<br>Valor final: " . $valorFinal;
echo "<br><br>";


/* ==========================================
RETO EXTRA — FACTURA SIMPLE
========================================== */

echo "<br><b>RETO EXTRA — FACTURA SIMPLE</b><br>";


$producto = "Reloj";
$precioUnitario = 80000;
$cantidad = 2;


$subtotal = $precioUnitario * $cantidad;


$iva = $subtotal * 0.19;


$total = $subtotal + $iva;


echo "Producto: " . $producto;
echo "<br>Precio unitario: $" . $precioUnitario;
echo "<br>Cantidad: " . $cantidad;
echo "<br>Subtotal: $" . $subtotal;
echo "<br>IVA (19%): $" . $iva;
echo "<br>Total a pagar: $" . $total;

echo "<br><br>";
echo "<hr>";
/* ==========================================
PARTE 2 — VALIDACIONES BÁSICAS EN PHP
========================================== */

echo "<h1>PARTE 2 — VALIDACIONES BÁSICAS EN PHP </h1>";

/* ==========================================
EJERCICIO 23 — VALIDAR NOTA
========================================== */

echo "<strong> EJERCICIO 23 — VALIDAR NOTA </strong> <br>";


$nota = 3.8;


if ($nota >= 3.5) {
    echo "El estudiante aprobo";
} else {
    echo "El estudiante reprobo";
}

echo "<br> <br>";

/* ==========================================
EJERCICIO 24 — MAYOR DE EDAD
========================================== */

echo "<strong> EJERCICIO 24 — MAYOR DE EDAD</strong> <br>";


$edad = 21;

if ($edad >= 18) {
    echo "El usuario es mayor de edad";
} else {
    echo "El usuario es menor de edad";
}

echo "<br> <br>";

/* ==========================================
EJERCICIO 25 — DESCUENTO EN COMPRA
========================================== */

echo "<strong> EJERCICIO 25 — DESCUENTO EN COMPRA </strong> <br>";


$compra = 100000;


if ($compra >= 200000) {


    $descuento = $compra * 0.28;


    $valortotal = $compra - $descuento;


    echo "Su compra de " . $compra . " tuvo un descuento de 28%, por lo que queda en " . $valortotal;
} else {


    echo "Su compra no tuvo descuento";
}

echo "<br> <br>";

/* ==========================================
EJERCICIO 26 — DISPONIBILIDAD DE PRODUCTO
========================================== */

echo "<strong> EJERCICIO 26 — DISPONIBILIDAD DE PRODUCTO </strong> <br>";


$producto = "Vive 100";
$cantidad = 13;


if ($cantidad > 0) {
    echo "Si hay disponible";
} else {
    echo "No hay disponible";
}

echo "<br> <br>";

/* ==========================================
RETO EXTRA — USO DE var_dump()
========================================== */

echo "<strong> RETO EXTRA — USO DE var_dump() </strong> <br>";

$numero = 10;

var_dump($numero == "10");

var_dump($numero === "10");

?>

