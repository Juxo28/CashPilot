# CashPilot

## Aprendiz

Julian David Palacio Latorre

## Descripcion

CashPilot es un proyecto de software orientado a la gestión de finanzas personales. Su objetivo es permitir el registro y control de ingresos, gastos y movimientos financieros de manera organizada.

## Como ejecutarlo

1. Importa `docs/database.sql` en MySQL (crea la base `cashpilot`).
2. Copia `.env.example` a `.env` y ajusta los datos.
3. Abre `http://localhost/CashPilot/public/` en el navegador.

## Estructura del proyecto

```text
CashPilot
│
├── public
│   ├── index.php     (router: decide que controlador llamar)
│   └── .htaccess
│
├── app
│   ├── controllers    (un controlador por modulo, con index/crear/guardar)
│   ├── models         (un modelo por tabla, con getAll/getByid/create)
│   └── views          (una carpeta por modulo: index.php y crear.php)
│
├── class
│   └── Persona.php    (clase de práctica de POO, aparte del modelo de BD)
│
├── config
│   └── Database.php
│
├── docs
│   └── database.sql
│
└── README.md
```
