<h1>Listado de Categoria</h1>

<table>
    <tr>

        <th>Nombre Categoria</th>
        <th>Tipo Categoria</th>
        <th>Descripcion</th>
    </tr>

    <?php foreach ($categorias as $categoria): ?>
        <tr>

            <td><?= $categoria['nombre_categoria'] ?></td>
            <td><?= $categoria['tipo_categoria'] ?></td>
            <td><?= $categoria['descripcion'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>