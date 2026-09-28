<h1>Usuarios</h1>

<p class="acciones"><a class="boton" href="<?= url('/usuario/crear') ?>">Nuevo usuario</a></p>

<?php if (!empty($usuarios)) : ?>
    <table>
        <tr><th>ID</th><th>Usuario</th><th>Persona</th><th>Correo</th><th>Rol</th><th>Estado</th></tr>
        <?php foreach ($usuarios as $usuario) : ?>
            <tr>
                <td><?= e($usuario['id_usuario']) ?></td>
                <td><?= e($usuario['usuario']) ?></td>
                <td><?= e($usuario['nombre'] . ' ' . $usuario['apellido']) ?></td>
                <td><?= e($usuario['correo']) ?></td>
                <td><?= e($usuario['rol']) ?></td>
                <td><?= $usuario['estado'] ? 'Activo' : 'Inactivo' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No hay usuarios para mostrar.</p>
<?php endif; ?>
