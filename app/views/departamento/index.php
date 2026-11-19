<h1>Listado de departamentos</h1>

<a href="/departamento/crear">Nuevo departamento</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Presupuesto</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($departamentos as $departamento): ?>
        <tr>
            <td><?= htmlspecialchars($departamento['id_departamento']) ?></td>
            <td><?= htmlspecialchars($departamento['nombre_departamento']) ?></td>
            <td><?= htmlspecialchars($departamento['descripcion'] ?? '') ?></td>
            <td><?= htmlspecialchars($departamento['presupuesto']) ?></td>
            <td><a href="/departamento/editar?id=<?= $departamento['id_departamento'] ?>">Editar</a></td>
            <td>
                <form action="/departamento/eliminar" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar: <?= htmlspecialchars($departamento['nombre_departamento'], ENT_QUOTES) ?>?')">
                    <input type="hidden" name="id_departamento" value="<?= $departamento['id_departamento'] ?>">
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
