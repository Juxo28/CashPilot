<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CashPilot</title>
    <link rel="stylesheet" href="<?= url('/estilos.css') ?>">
</head>
<body>
    <nav>
        <strong>CashPilot</strong>
        <?php foreach ($modulos as $nombre => $clase) : ?>
            <a href="<?= url('/' . $nombre) ?>"><?= e(ucfirst($nombre)) ?></a>
        <?php endforeach; ?>
    </nav>

    <main>
        <?php if (isset($_GET['guardado'])) : ?>
            <p class="ok">Registro guardado correctamente.</p>
        <?php endif; ?>

        <?= $contenido ?>
    </main>
</body>
</html>
