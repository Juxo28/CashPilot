<?php
$rutas =[
    "GET" => [
        "/empresa"=>["empresaController","index"],
        "/categoria"=>["categoriaController","index"],
        "/departamento"=>["departamentoController","index"],
    ],

    "POST" => [
        "/empresa/crear" => ["empresaController","crear"]
    ]
];

return $rutas;