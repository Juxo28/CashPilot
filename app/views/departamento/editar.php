<h1>Actualizando departamento</h1>

<form action="/departamento/editar" method="POST">

    <input type="hidden" name="id_departamento" value="<?= $departamento['id_departamento'] ?>">

    <label for="nombre_departamento">Nombre</label><br>
    <input type="text" id="nombre_departamento" name="nombre_departamento" value="<?= htmlspecialchars($departamento['nombre_departamento']) ?>" required><br><br>

    <label for="descripcion">Descripcion</label><br>
    <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($departamento['descripcion'] ?? '') ?>"><br><br>

    <label for="presupuesto">Presupuesto</label><br>
    <input type="number" id="presupuesto" name="presupuesto" min="0" step="0.01" value="<?= htmlspecialchars($departamento['presupuesto']) ?>" required><br><br>

    <button type="submit">Guardar</button>
    <a href="/departamento">Cancelar</a>
</form>
