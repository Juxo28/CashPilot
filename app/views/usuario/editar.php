<h1>Actualizando usuario</h1>

<form action="/usuario/editar" method="POST">

    <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">

    <label for="id_persona">Persona</label><br>
    <select id="id_persona" name="id_persona">
        <?php foreach ($personas as $persona): ?>
            <option value="<?= $persona['id_persona'] ?>" <?= $persona['id_persona'] == $usuario['id_persona'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($persona['nombre'] . " " . $persona['apellido']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="id_rol">Rol</label><br>
    <select id="id_rol" name="id_rol">
        <?php foreach ($roles as $rol): ?>
            <option value="<?= $rol['id_rol'] ?>" <?= $rol['id_rol'] == $usuario['id_rol'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($rol['nombre_rol']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="usuario">Usuario</label><br>
    <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required><br><br>

    <label for="estado">Estado</label><br>
    <select id="estado" name="estado">
        <option value="1" <?= $usuario['estado'] == 1 ? 'selected' : '' ?>>Activo</option>
        <option value="0" <?= $usuario['estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
    </select><br><br>

    <label for="password">Nueva contraseña (déjala vacía para no cambiarla)</label><br>
    <input type="password" id="password" name="password"><br><br>

    <button type="submit">Guardar</button>
    <a href="/usuario">Cancelar</a>
</form>
