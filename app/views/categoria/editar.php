<h1>Actualizando categoria</h1>

<form action="<?= url('/categoria/editar') ?>" method="POST">

    <input type="hidden" name="id_categoria" value="<?= $categoria['id_categoria'] ?>">

    <label for="nombre_categoria">Nombre de la categoria</label><br>
    <input type="text" id="nombre_categoria" name="nombre_categoria" value="<?= htmlspecialchars($categoria['nombre_categoria']) ?>" required><br><br>

    <label for="tipo_categoria">Tipo</label><br>
    <select id="tipo_categoria" name="tipo_categoria">
        <option value="ingreso" <?= $categoria['tipo_categoria'] == 'ingreso' ? 'selected' : '' ?>>Ingreso</option>
        <option value="gasto" <?= $categoria['tipo_categoria'] == 'gasto' ? 'selected' : '' ?>>Gasto</option>
    </select><br><br>

    <label for="descripcion">Descripcion</label><br>
    <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($categoria['descripcion'] ?? '') ?>"><br><br>

    <button type="submit">Guardar</button>
    <a href="<?= url('/categoria') ?>">Cancelar</a>
</form>
