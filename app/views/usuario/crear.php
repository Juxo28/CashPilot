<h1>Nuevo usuario</h1>

<?php if (empty($personas)): ?>
    <p>Todas las personas ya tienen usuario. Primero <a href="<?= url('/persona/crear') ?>">crea una persona</a>.</p>
<?php else: ?>
<form method="POST" action="<?= url('/usuario') ?>">
    <label for="id_persona">Persona</label><br>
    <select id="id_persona" name="id_persona">
        <?php foreach ($personas as $persona): ?>
            <option value="<?= htmlspecialchars($persona['id_persona']) ?>">
                <?= htmlspecialchars($persona['nombre'] . " " . $persona['apellido']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="id_rol">Rol</label><br>
    <select id="id_rol" name="id_rol">
        <?php foreach ($roles as $rol): ?>
            <option value="<?= htmlspecialchars($rol['id_rol']) ?>">
                <?= htmlspecialchars($rol['nombre_rol']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="usuario">Usuario</label><br>
    <input type="text" id="usuario" name="usuario" required><br><br>

    <label for="password">Contraseña</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Guardar</button>
    <a href="<?= url('/usuario') ?>">Cancelar</a>
</form>
<?php endif; ?>
