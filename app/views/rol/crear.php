<h1>Nuevo rol</h1>

<form method="POST" action="<?= url('/rol') ?>">
    <label for="nombre_rol">Nombre</label><br>
    <input type="text" id="nombre_rol" name="nombre_rol" required><br><br>

    <label for="descripcion">Descripcion</label><br>
    <input type="text" id="descripcion" name="descripcion"><br><br>

    <button type="submit">Guardar</button>
    <a href="<?= url('/rol') ?>">Cancelar</a>
</form>
