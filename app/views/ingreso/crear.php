<h1>Nuevo ingreso</h1>

<?php require __DIR__ . "/../partials/errores.php"; ?>

<form method="post" action="<?= url('/ingreso') ?>">
    <label for="id_categoria">Categoría de ingreso</label>
    <select id="id_categoria" name="id_categoria" required>
        <option value="">-- Elige --</option>
        <?php foreach ($categorias as $categoria) : ?>
            <option value="<?= e($categoria['id_categoria']) ?>"
                <?= (string) ($old['id_categoria'] ?? '') === (string) $categoria['id_categoria'] ? 'selected' : '' ?>>
                <?= e($categoria['nombre_categoria']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="monto">Monto <small>(sin puntos de miles, ejemplo: 5000000)</small></label>
    <input type="text" id="monto" name="monto" inputmode="decimal" required
           value="<?= e($old['monto'] ?? '') ?>">

    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="fecha" required value="<?= e($old['fecha'] ?? '') ?>">

    <label for="descripcion">Descripción</label>
    <input type="text" id="descripcion" name="descripcion" maxlength="255" required
           value="<?= e($old['descripcion'] ?? '') ?>">

    <label for="fuente">Fuente <small>(quién pagó, opcional)</small></label>
    <input type="text" id="fuente" name="fuente" maxlength="120"
           value="<?= e($old['fuente'] ?? '') ?>">

    <button class="boton" type="submit">Guardar</button>
    <a class="boton secundario" href="<?= url('/ingreso') ?>">Cancelar</a>
</form>
