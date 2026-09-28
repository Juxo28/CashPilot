<h1>Nueva empresa</h1>

<?php require __DIR__ . "/../partials/errores.php"; ?>

<form method="post" action="<?= url('/empresa') ?>">
    <label for="nombre_empresa">Nombre de la empresa</label>
    <input type="text" id="nombre_empresa" name="nombre_empresa" maxlength="120" required
           value="<?= e($old['nombre_empresa'] ?? '') ?>">

    <label for="nit">NIT</label>
    <input type="text" id="nit" name="nit" maxlength="20" required placeholder="900123456-7"
           value="<?= e($old['nit'] ?? '') ?>">

    <label for="direccion">Dirección <small>(opcional)</small></label>
    <input type="text" id="direccion" name="direccion" maxlength="200"
           value="<?= e($old['direccion'] ?? '') ?>">

    <label for="telefono">Teléfono <small>(opcional)</small></label>
    <input type="text" id="telefono" name="telefono" maxlength="20"
           value="<?= e($old['telefono'] ?? '') ?>">

    <label for="correo">Correo <small>(opcional)</small></label>
    <input type="email" id="correo" name="correo" maxlength="120"
           value="<?= e($old['correo'] ?? '') ?>">

    <button class="boton" type="submit">Guardar</button>
    <a class="boton secundario" href="<?= url('/empresa') ?>">Cancelar</a>
</form>
