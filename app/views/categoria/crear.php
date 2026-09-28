<h1>Nueva categoría</h1>

<?php require __DIR__ . "/../partials/errores.php"; ?>

<form method="post" action="<?= url('/categoria') ?>">
    <label for="nombre_categoria">Nombre</label>
    <input type="text" id="nombre_categoria" name="nombre_categoria" maxlength="60" required
           value="<?= e($old['nombre_categoria'] ?? '') ?>">

    <label for="tipo_categoria">Tipo</label>
    <select id="tipo_categoria" name="tipo_categoria" required>
        <option value="">-- Elige --</option>
        <option value="ingreso" <?= ($old['tipo_categoria'] ?? '') === 'ingreso' ? 'selected' : '' ?>>Ingreso</option>
        <option value="gasto"   <?= ($old['tipo_categoria'] ?? '') === 'gasto'   ? 'selected' : '' ?>>Gasto</option>
    </select>

    <label for="descripcion">Descripción <small>(opcional)</small></label>
    <input type="text" id="descripcion" name="descripcion" maxlength="255"
           value="<?= e($old['descripcion'] ?? '') ?>">

    <button class="boton" type="submit">Guardar</button>
    <a class="boton secundario" href="<?= url('/categoria') ?>">Cancelar</a>
</form>
