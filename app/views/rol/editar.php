<h1>Actualizando rol</h1>

<form action="<?= url('/rol/editar') ?>" method="POST">

    <input type="hidden" name="id_rol" value="<?= $rol['id_rol'] ?>">

    <label for="nombre_rol">Nombre</label><br>
    <input type="text" id="nombre_rol" name="nombre_rol" value="<?= htmlspecialchars($rol['nombre_rol']) ?>" required><br><br>

    <label for="descripcion">Descripcion</label><br>
    <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($rol['descripcion'] ?? '') ?>"><br><br>

    <button type="submit">Guardar</button>
    <a href="<?= url('/rol') ?>">Cancelar</a>
</form>
