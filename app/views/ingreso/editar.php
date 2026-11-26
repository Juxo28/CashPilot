<h1>Actualizando ingreso</h1>

<form action="<?= url('/ingreso/editar') ?>" method="POST">

    <input type="hidden" name="id_ingreso" value="<?= $ingreso['id_ingreso'] ?>">

    <label for="id_categoria">Categoria</label><br>
    <select id="id_categoria" name="id_categoria" required>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id_categoria'] ?>" <?= $categoria['id_categoria'] == $ingreso['id_categoria'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($categoria['nombre_categoria']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="monto">Monto</label><br>
    <input type="number" id="monto" name="monto" min="0.01" step="0.01" value="<?= htmlspecialchars($ingreso['monto']) ?>" required><br><br>

    <label for="fecha">Fecha</label><br>
    <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars($ingreso['fecha']) ?>" required><br><br>

    <label for="descripcion">Descripcion</label><br>
    <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($ingreso['descripcion']) ?>" required><br><br>

    <label for="fuente">Fuente</label><br>
    <input type="text" id="fuente" name="fuente" value="<?= htmlspecialchars($ingreso['fuente'] ?? '') ?>"><br><br>

    <button type="submit">Guardar</button>
    <a href="<?= url('/ingreso') ?>">Cancelar</a>
</form>
