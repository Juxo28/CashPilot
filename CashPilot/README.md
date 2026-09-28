# CashPilot

## Aprendiz

Julian David Palacio Latorre

## Descripción

CashPilot es una aplicación web de gestión y control financiero (ingresos, gastos, categorías,
departamentos, usuarios y roles) construida con PHP, MySQL y arquitectura MVC.

## Cómo ejecutarlo

1. Importa `docs/database.sql` en MySQL (crea la base `cashpilot`).
2. Copia `.env.example` a `.env` y ajusta los datos de conexión.
3. Coloca el proyecto en `htdocs` y abre `http://localhost/CashPilot/public/`.
   (Apache necesita `mod_rewrite` y `AllowOverride All` para leer `public/.htaccess`.)

## Estructura

```text
CashPilot
├── config        Database.php, helpers.php, app.php
├── class         Persona.php (clase de práctica de POO)
├── public        index.php (router), .htaccess, estilos.css
├── app
│   ├── controllers   un controlador por módulo (index, crear, guardar)
│   ├── models        un modelo por tabla
│   └── views         una carpeta por módulo: index.php (lista) y crear.php (formulario)
└── docs          database.sql
```
