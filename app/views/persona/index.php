<h1>Listado de personas</h1>

<a href="/persona/crear">Nueva persona</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($personas as $persona): ?>
        <tr>
            <td><?= htmlspecialchars($persona['id_persona']) ?></td>
            <td><?= htmlspecialchars($persona['nombre']) ?></td>
            <td><?= htmlspecialchars($persona['apellido']) ?></td>
            <td><?= htmlspecialchars($persona['telefono'] ?? '') ?></td>
            <td><?= htmlspecialchars($persona['correo'] ?? '') ?></td>
            <td><a href="/persona/editar?id=<?= $persona['id_persona'] ?>">Editar</a></td>
            <td>
                <form action="/persona/eliminar" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar: <?= htmlspecialchars($persona['nombre'] . ' ' . $persona['apellido'], ENT_QUOTES) ?>?')">
                    <input type="hidden" name="id_persona" value="<?= $persona['id_persona'] ?>">
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
