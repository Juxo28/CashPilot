<h1>Nuevo gasto</h1>

<form method="POST" action="/gasto">
    Departamento:<br>
    <select name="id_departamento">
        <?php foreach ($departamentos as $departamento): ?>
            <option value="<?= htmlspecialchars($departamento['id_departamento']) ?>">
                <?= htmlspecialchars($departamento['nombre_departamento']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    Categoria:<br>
    <select name="id_categoria">
        <?php foreach ($categorias as $categoria): ?>
            <?php if ($categoria['tipo_categoria'] == 'gasto'): ?>
                <option value="<?= htmlspecialchars($categoria['id_categoria']) ?>">
                    <?= htmlspecialchars($categoria['nombre_categoria']) ?>
                </option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select><br><br>

    Monto:<br>
    <input type="text" name="monto"><br><br>

    Fecha:<br>
    <input type="date" name="fecha"><br><br>

    Descripcion:<br>
    <input type="text" name="descripcion"><br><br>

    Metodo de pago:<br>
    <select name="metodo_pago">
        <option value="Efectivo">Efectivo</option>
        <option value="Tarjeta">Tarjeta</option>
        <option value="Transferencia">Transferencia</option>
    </select><br><br>

    Comprobante:<br>
    <input type="text" name="comprobante"><br><br>

    <button type="submit">Guardar</button>
</form>
