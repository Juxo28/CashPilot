<?php
$rutas = [
    "GET" => [
        "/empresa"          => ["empresaController", "index"],
        "/empresa/crear"    => ["empresaController", "crear"],
        "/empresa/editar"   => ["empresaController", "editar"],
        "/api/empresa"      => ["empresaController", "listarJson"],
        "/categoria"        => ["categoriaController", "index"],
        "/departamento"     => ["departamentoController", "index"],
    ],

    "POST" => [
        "/empresa/guardar"  => ["empresaController", "guardar"],
        "/empresa/editar"   => ["empresaController", "actualizar"],
        "/empresa/eliminar" => ["empresaController", "eliminar"],
    ]
];

return $rutas;
