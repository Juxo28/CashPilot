<h1>Listado de ingresos</h1>

<a href="/ingreso/crear">Nuevo ingreso</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Descripcion</th>
        <th>Categoria</th>
        <th>Fuente</th>
        <th>Usuario</th>
        <th>Monto</th>
    </tr>

    <?php foreach ($ingresos as $ingreso): ?>
        <tr>
            <td><?= htmlspecialchars($ingreso['id_ingreso']) ?></td>
            <td><?= htmlspecialchars($ingreso['fecha']) ?></td>
            <td><?= htmlspecialchars($ingreso['descripcion']) ?></td>
            <td><?= htmlspecialchars($ingreso['nombre_categoria']) ?></td>
            <td><?= htmlspecialchars($ingreso['fuente']) ?></td>
            <td><?= htmlspecialchars($ingreso['usuario']) ?></td>
            <td><?= htmlspecialchars($ingreso['monto']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
