<?php


echo "<h1>Ejercicio 1. De PHP a JSON</h1>";


$arreglo = [
    [  
     "id" => 1,
     "nombre" => "Monitor",
     "precio" => 500000,
     "stock" => 5,
     "disponibilidad" => true
     ],
    [  
     "id" => 2,
     "nombre" => "Portatil",
     "precio" => 1000000,
     "stock" => 2,
     "disponibilidad" => false
     ],
    [  
     "id" => 3,
     "nombre" => "Teclado",
     "precio" => 120000,
     "stock" => 1,
     "disponibilidad" => true
     ]
];

echo "<h3>JSON_ENCODE NORMAL</h3>" . "<pre>". json_encode($arreglo) . "</pre>";
 
$arreglo[] = [
    "id" => 4,
    "nombre" => "Mouse",
    "precio" => 45000,
    "stock" => 8,
    "disponibilidad" => true

];

echo "<h3>JSON_ENCODE con JSON_PRETTY_PRINT </h3>" . "<pre>". json_encode($arreglo,JSON_PRETTY_PRINT) . "</pre>";


echo "<h1>Ejercicio 2. De JSON a PHP </h1>";

$contenidoJSON = file_get_contents('productos.json');

$productos = json_decode($contenidoJSON, true);

foreach ($productos as $producto) {
    echo $producto["nombre"] . " -$" . $producto["precio"] . "<br>";
}

foreach ($productos as $producto) {
    if ($producto["precio"] > 100000){
       echo $producto["nombre"] . " - $" . $producto["precio"] . "<br>";
    }
}

echo "<h1>Ejercicio 3. Modificar y convertir información</h1>";

$idBuscado = 3;
$nuevoPrecio = 850000;


foreach ($productos as $indice => $producto) {
    if ($producto["id"] == $idBuscado) {
        echo "Producto encontrado: " . $producto["nombre"] . "<br>";
        echo "Precio anterior: $" . $producto["precio"] . "<br>";
        $productos[$indice]["precio"] = $nuevoPrecio;
        echo "Precio nuevo: $" . $productos[$indice]["precio"] . "<br>";
    }
}

$nuevoJSON = json_encode($productos, JSON_PRETTY_PRINT);

echo "<pre>" . $nuevoJSON . "</pre>";
