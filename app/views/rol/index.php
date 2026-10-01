<h1>Listado de roles</h1>

<a href="/rol/crear">Nuevo rol</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
    </tr>

    <?php foreach ($roles as $rol): ?>
        <tr>
            <td><?= htmlspecialchars($rol['id_rol']) ?></td>
            <td><?= htmlspecialchars($rol['nombre_rol']) ?></td>
            <td><?= htmlspecialchars($rol['descripcion']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
