<h1>Nuevo gasto</h1>

<?php require __DIR__ . "/../partials/errores.php"; ?>

<form method="post" action="<?= url('/gasto') ?>">
    <label for="id_departamento">Departamento</label>
    <select id="id_departamento" name="id_departamento" required>
        <option value="">-- Elige --</option>
        <?php foreach ($departamentos as $departamento) : ?>
            <option value="<?= e($departamento['id_departamento']) ?>"
                <?= (string) ($old['id_departamento'] ?? '') === (string) $departamento['id_departamento'] ? 'selected' : '' ?>>
                <?= e($departamento['nombre_departamento']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="id_categoria">Categoría de gasto</label>
    <select id="id_categoria" name="id_categoria" required>
        <option value="">-- Elige --</option>
        <?php foreach ($categorias as $categoria) : ?>
            <option value="<?= e($categoria['id_categoria']) ?>"
                <?= (string) ($old['id_categoria'] ?? '') === (string) $categoria['id_categoria'] ? 'selected' : '' ?>>
                <?= e($categoria['nombre_categoria']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="monto">Monto <small>(sin puntos de miles, ejemplo: 250000)</small></label>
    <input type="text" id="monto" name="monto" inputmode="decimal" required
           value="<?= e($old['monto'] ?? '') ?>">

    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="fecha" required value="<?= e($old['fecha'] ?? '') ?>">

    <label for="descripcion">Descripción</label>
    <input type="text" id="descripcion" name="descripcion" maxlength="255" required
           value="<?= e($old['descripcion'] ?? '') ?>">

    <label for="metodo_pago">Método de pago</label>
    <select id="metodo_pago" name="metodo_pago" required>
        <option value="">-- Elige --</option>
        <?php foreach ($metodosPago as $metodo) : ?>
            <option value="<?= e($metodo) ?>" <?= ($old['metodo_pago'] ?? '') === $metodo ? 'selected' : '' ?>>
                <?= e($metodo) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="comprobante">Comprobante <small>(nombre del archivo, opcional)</small></label>
    <input type="text" id="comprobante" name="comprobante" maxlength="150"
           value="<?= e($old['comprobante'] ?? '') ?>">

    <button class="boton" type="submit">Guardar</button>
    <a class="boton secundario" href="<?= url('/gasto') ?>">Cancelar</a>
</form>
