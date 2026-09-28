<h1>Nuevo usuario</h1>

<form method="POST" action="/usuario">
    Persona:<br>
    <select name="id_persona">
        <?php foreach ($personas as $persona): ?>
            <option value="<?= htmlspecialchars($persona['id_persona']) ?>">
                <?= htmlspecialchars($persona['nombre'] . " " . $persona['apellido']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    Rol:<br>
    <select name="id_rol">
        <?php foreach ($roles as $rol): ?>
            <option value="<?= htmlspecialchars($rol['id_rol']) ?>">
                <?= htmlspecialchars($rol['nombre_rol']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    Usuario:<br>
    <input type="text" name="usuario"><br><br>

    Contraseña:<br>
    <input type="password" name="password"><br><br>

    <button type="submit">Guardar</button>
</form>
