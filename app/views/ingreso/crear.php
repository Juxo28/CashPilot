<h1>Nuevo ingreso</h1>

<form method="POST" action="/ingreso">
    Categoria:<br>
    <select name="id_categoria">
        <?php foreach ($categorias as $categoria): ?>
            <?php if ($categoria['tipo_categoria'] == 'ingreso'): ?>
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

    Fuente:<br>
    <input type="text" name="fuente"><br><br>

    <button type="submit">Guardar</button>
</form>
