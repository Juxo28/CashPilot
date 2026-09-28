<h1>Listado de categorias</h1>

<a href="/categoria/crear">Nueva categoria</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Descripcion</th>
    </tr>

    <?php foreach ($categorias as $categoria): ?>
        <tr>
            <td><?= htmlspecialchars($categoria['id_categoria']) ?></td>
            <td><?= htmlspecialchars($categoria['nombre_categoria']) ?></td>
            <td><?= htmlspecialchars($categoria['tipo_categoria']) ?></td>
            <td><?= htmlspecialchars($categoria['descripcion']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
