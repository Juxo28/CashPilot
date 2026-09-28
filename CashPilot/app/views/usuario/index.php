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
    </tr>

    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
            <td><?= htmlspecialchars($usuario['usuario']) ?></td>
            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
            <td><?= htmlspecialchars($usuario['apellido']) ?></td>
            <td><?= htmlspecialchars($usuario['nombre_rol']) ?></td>
            <td><?= htmlspecialchars($usuario['estado']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
