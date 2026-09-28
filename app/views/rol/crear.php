<h1>Nuevo rol</h1>

<?php require __DIR__ . "/../partials/errores.php"; ?>

<form method="post" action="<?= url('/rol') ?>">
    <label for="nombre_rol">Nombre del rol</label>
    <input type="text" id="nombre_rol" name="nombre_rol" maxlength="40" required
           value="<?= e($old['nombre_rol'] ?? '') ?>">

    <label for="descripcion">Descripción <small>(opcional)</small></label>
    <input type="text" id="descripcion" name="descripcion" maxlength="255"
           value="<?= e($old['descripcion'] ?? '') ?>">

    <button class="boton" type="submit">Guardar</button>
    <a class="boton secundario" href="<?= url('/rol') ?>">Cancelar</a>
</form>
