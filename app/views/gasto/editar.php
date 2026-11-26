<h1>Actualizando gasto</h1>

<form action="<?= url('/gasto/editar') ?>" method="POST">

    <input type="hidden" name="id_gasto" value="<?= $gasto['id_gasto'] ?>">

    <label for="id_departamento">Departamento</label><br>
    <select id="id_departamento" name="id_departamento" required>
        <?php foreach ($departamentos as $departamento): ?>
            <option value="<?= $departamento['id_departamento'] ?>" <?= $departamento['id_departamento'] == $gasto['id_departamento'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($departamento['nombre_departamento']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="id_categoria">Categoria</label><br>
    <select id="id_categoria" name="id_categoria" required>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id_categoria'] ?>" <?= $categoria['id_categoria'] == $gasto['id_categoria'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($categoria['nombre_categoria']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="monto">Monto</label><br>
    <input type="number" id="monto" name="monto" min="0.01" step="0.01" value="<?= htmlspecialchars($gasto['monto']) ?>" required><br><br>

    <label for="fecha">Fecha</label><br>
    <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars($gasto['fecha']) ?>" required><br><br>

    <label for="descripcion">Descripcion</label><br>
    <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($gasto['descripcion']) ?>" required><br><br>

    <label for="metodo_pago">Metodo de pago</label><br>
    <select id="metodo_pago" name="metodo_pago">
        <?php foreach (['Efectivo', 'Tarjeta', 'Transferencia'] as $metodo): ?>
            <option value="<?= $metodo ?>" <?= $metodo == $gasto['metodo_pago'] ? 'selected' : '' ?>><?= $metodo ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="comprobante">Comprobante</label><br>
    <input type="text" id="comprobante" name="comprobante" value="<?= htmlspecialchars($gasto['comprobante'] ?? '') ?>"><br><br>

    <button type="submit">Guardar</button>
    <a href="<?= url('/gasto') ?>">Cancelar</a>
</form>
