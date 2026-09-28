<h1>Nuevo usuario</h1>

<?php require __DIR__ . "/../partials/errores.php"; ?>

<?php if (empty($personas)) : ?>
    <p>No hay personas sin usuario. <a href="<?= url('/persona/crear') ?>">Crea primero una persona</a>.</p>
<?php else : ?>
<form method="post" action="<?= url('/usuario') ?>">
    <label for="id_persona">Persona</label>
    <select id="id_persona" name="id_persona" required>
        <option value="">-- Elige --</option>
        <?php foreach ($personas as $persona) : ?>
            <option value="<?= e($persona['id_persona']) ?>"
                <?= (string) ($old['id_persona'] ?? '') === (string) $persona['id_persona'] ? 'selected' : '' ?>>
                <?= e($persona['nombre'] . ' ' . $persona['apellido']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="id_rol">Rol</label>
    <select id="id_rol" name="id_rol" required>
        <option value="">-- Elige --</option>
        <?php foreach ($roles as $rol) : ?>
            <option value="<?= e($rol['id_rol']) ?>"
                <?= (string) ($old['id_rol'] ?? '') === (string) $rol['id_rol'] ? 'selected' : '' ?>>
                <?= e($rol['nombre_rol']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="usuario">Usuario <small>(3 a 40 caracteres: letras, números, . - _)</small></label>
    <input type="text" id="usuario" name="usuario" maxlength="40" required autocomplete="off"
           value="<?= e($old['usuario'] ?? '') ?>">

    <label for="password">Contraseña <small>(mínimo 8 caracteres)</small></label>
    <input type="password" id="password" name="password" minlength="8" required autocomplete="new-password">

    <label for="password2">Repite la contraseña</label>
    <input type="password" id="password2" name="password2" minlength="8" required autocomplete="new-password">

    <button class="boton" type="submit">Guardar</button>
    <a class="boton secundario" href="<?= url('/usuario') ?>">Cancelar</a>
</form>
<?php endif; ?>
