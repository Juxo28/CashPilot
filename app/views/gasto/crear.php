<h1>Nuevo gasto</h1>

<form method="POST" action="<?= url('/gasto') ?>">
    <label for="id_departamento">Departamento</label><br>
    <select id="id_departamento" name="id_departamento" required>
        <?php foreach ($departamentos as $departamento): ?>
            <option value="<?= htmlspecialchars($departamento['id_departamento']) ?>">
                <?= htmlspecialchars($departamento['nombre_departamento']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="id_categoria">Categoria</label><br>
    <select id="id_categoria" name="id_categoria" required>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= htmlspecialchars($categoria['id_categoria']) ?>">
                <?= htmlspecialchars($categoria['nombre_categoria']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="monto">Monto</label><br>
    <input type="number" id="monto" name="monto" min="0.01" step="0.01" required><br><br>

    <label for="fecha">Fecha</label><br>
    <input type="date" id="fecha" name="fecha" value="<?= date('Y-m-d') ?>" required><br><br>

    <label for="descripcion">Descripcion</label><br>
    <input type="text" id="descripcion" name="descripcion" required><br><br>

    <label for="metodo_pago">Metodo de pago</label><br>
    <select id="metodo_pago" name="metodo_pago">
        <option value="Efectivo">Efectivo</option>
        <option value="Tarjeta">Tarjeta</option>
        <option value="Transferencia">Transferencia</option>
    </select><br><br>

    <label for="comprobante">Comprobante</label><br>
    <input type="text" id="comprobante" name="comprobante"><br><br>

    <button type="submit">Guardar</button>
    <a href="<?= url('/gasto') ?>">Cancelar</a>
</form>
