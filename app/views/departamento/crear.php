<h1>Nuevo departamento</h1>

<?php require __DIR__ . "/../partials/errores.php"; ?>

<form method="post" action="<?= url('/departamento') ?>">
    <label for="nombre_departamento">Nombre</label>
    <input type="text" id="nombre_departamento" name="nombre_departamento" maxlength="80" required
           value="<?= e($old['nombre_departamento'] ?? '') ?>">

    <label for="descripcion">Descripción <small>(opcional)</small></label>
    <input type="text" id="descripcion" name="descripcion" maxlength="255"
           value="<?= e($old['descripcion'] ?? '') ?>">

    <label for="presupuesto">Presupuesto <small>(sin puntos de miles; opcional)</small></label>
    <input type="text" id="presupuesto" name="presupuesto" inputmode="decimal" placeholder="15000000"
           value="<?= e($old['presupuesto'] ?? '') ?>">

    <button class="boton" type="submit">Guardar</button>
    <a class="boton secundario" href="<?= url('/departamento') ?>">Cancelar</a>
</form>
