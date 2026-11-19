<h1>Actualizando persona</h1>

<form action="/persona/editar" method="POST">

    <input type="hidden" name="id_persona" value="<?= $persona['id_persona'] ?>">

    <label for="nombre">Nombre</label><br>
    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($persona['nombre']) ?>" required><br><br>

    <label for="apellido">Apellido</label><br>
    <input type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($persona['apellido']) ?>" required><br><br>

    <label for="telefono">Telefono</label><br>
    <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($persona['telefono'] ?? '') ?>"><br><br>

    <label for="correo">Correo</label><br>
    <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($persona['correo'] ?? '') ?>"><br><br>

    <button type="submit">Guardar</button>
    <a href="/persona">Cancelar</a>
</form>
