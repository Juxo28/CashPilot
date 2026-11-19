<h1>Listado de roles</h1>

<a href="/rol/crear">Nuevo rol</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($roles as $rol): ?>
        <tr>
            <td><?= htmlspecialchars($rol['id_rol']) ?></td>
            <td><?= htmlspecialchars($rol['nombre_rol']) ?></td>
            <td><?= htmlspecialchars($rol['descripcion'] ?? '') ?></td>
            <td><a href="/rol/editar?id=<?= $rol['id_rol'] ?>">Editar</a></td>
            <td>
                <form action="/rol/eliminar" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar: <?= htmlspecialchars($rol['nombre_rol'], ENT_QUOTES) ?>?')">
                    <input type="hidden" name="id_rol" value="<?= $rol['id_rol'] ?>">
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
