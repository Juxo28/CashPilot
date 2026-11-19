<h1>Nuevo ingreso</h1>

<form method="POST" action="/ingreso">
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

    <label for="fuente">Fuente</label><br>
    <input type="text" id="fuente" name="fuente"><br><br>

    <button type="submit">Guardar</button>
    <a href="/ingreso">Cancelar</a>
</form>
