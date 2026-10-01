<h1>Editar persona</h1>

<form method="GET" action="/persona/actualizar">
    <input type="hidden" name="id_persona" value="<?= htmlspecialchars($persona['id_persona']) ?>">

    Nombre:<br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($persona['nombre']) ?>"><br><br>

    Apellido:<br>
    <input type="text" name="apellido" value="<?= htmlspecialchars($persona['apellido']) ?>"><br><br>

    Telefono:<br>
    <input type="text" name="telefono" value="<?= htmlspecialchars($persona['telefono']) ?>"><br><br>

    Correo:<br>
    <input type="text" name="correo" value="<?= htmlspecialchars($persona['correo']) ?>"><br><br>

    <button type="submit">Guardar cambios</button>
</form>
