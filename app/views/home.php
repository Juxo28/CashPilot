<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CashPilot</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <!-- Tus estilos propios van DESPUÉS de Bootstrap, para poder sobrescribirlo -->
    <link rel="stylesheet" href="<?= url('/assets/css/app.css') ?>">
</head>
<body>

<!-- Menú principal: un solo lugar para todos los módulos -->
<nav class="navbar navbar-expand-lg bg-dark mb-4" data-bs-theme="dark">
    <div class="container">

        <!-- Logo / nombre: lleva al inicio -->
        <a class="navbar-brand fw-bold" href="<?= url('/') ?>">CashPilot</a>

        <!-- Botón ☰ que solo aparece en pantallas pequeñas -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
                aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Lo que se esconde/muestra con el botón ☰ -->
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= url('/empresa') ?>">Empresas</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/departamento') ?>">Departamentos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/categoria') ?>">Categorías</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/gasto') ?>">Gastos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/ingreso') ?>">Ingresos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/usuario') ?>">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/persona') ?>">Personas</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('/rol') ?>">Roles</a></li>
            </ul>
        </div>

    </div>
</nav>

<main class="container">
    <?php if ($contenido === ''): ?>
        <!-- Página de inicio: no hay módulo que mostrar -->
        <div class="text-center py-5">
            <h1 class="display-5 fw-bold">Bienvenido a CashPilot</h1>
            <p class="lead text-muted">Elige un módulo en el menú.</p>
        </div>
    <?php else: ?>
        <!-- Aquí aparece la página del módulo (tabla, formulario, etc.) -->
        <?= $contenido ?>
    <?php endif; ?>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>