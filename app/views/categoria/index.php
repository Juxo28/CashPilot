<h1>Listado de categorias</h1>

<a href="/categoria/crear">Nueva categoria</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Descripcion</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($categorias as $categoria): ?>
        <tr>
            <td><?= htmlspecialchars($categoria['id_categoria']) ?></td>
            <td><?= htmlspecialchars($categoria['nombre_categoria']) ?></td>
            <td><?= htmlspecialchars($categoria['tipo_categoria']) ?></td>
            <td><?= htmlspecialchars($categoria['descripcion'] ?? '') ?></td>
            <td><a href="/categoria/editar?id=<?= $categoria['id_categoria'] ?>">Editar</a></td>
            <td>
                <form action="/categoria/eliminar" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar: <?= htmlspecialchars($categoria['nombre_categoria'], ENT_QUOTES) ?>?')">
                    <input type="hidden" name="id_categoria" value="<?= $categoria['id_categoria'] ?>">
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
