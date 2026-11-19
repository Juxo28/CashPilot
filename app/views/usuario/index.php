<h1>Listado de usuarios</h1>

<a href="/usuario/crear">Nuevo usuario</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Rol</th>
        <th>Estado</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
            <td><?= htmlspecialchars($usuario['usuario']) ?></td>
            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
            <td><?= htmlspecialchars($usuario['apellido']) ?></td>
            <td><?= htmlspecialchars($usuario['nombre_rol']) ?></td>
            <td><?= $usuario['estado'] == 1 ? 'Activo' : 'Inactivo' ?></td>
            <td><a href="/usuario/editar?id=<?= $usuario['id_usuario'] ?>">Editar</a></td>
            <td>
                <form action="/usuario/eliminar" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar: <?= htmlspecialchars($usuario['usuario'], ENT_QUOTES) ?>?')">
                    <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
