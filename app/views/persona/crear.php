<h1>Nueva persona</h1>

<?php require __DIR__ . "/../partials/errores.php"; ?>

<form method="post" action="<?= url('/persona') ?>">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" maxlength="60" required
           value="<?= e($old['nombre'] ?? '') ?>">

    <label for="apellido">Apellido</label>
    <input type="text" id="apellido" name="apellido" maxlength="60" required
           value="<?= e($old['apellido'] ?? '') ?>">

    <label for="telefono">Teléfono <small>(opcional)</small></label>
    <input type="text" id="telefono" name="telefono" maxlength="20"
           value="<?= e($old['telefono'] ?? '') ?>">

    <label for="correo">Correo <small>(opcional)</small></label>
    <input type="email" id="correo" name="correo" maxlength="120"
           value="<?= e($old['correo'] ?? '') ?>">

    <button class="boton" type="submit">Guardar</button>
    <a class="boton secundario" href="<?= url('/persona') ?>">Cancelar</a>
</form>
