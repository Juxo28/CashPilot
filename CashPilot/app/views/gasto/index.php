<h1>Listado de gastos</h1>

<a href="/gasto/crear">Nuevo gasto</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Descripcion</th>
        <th>Categoria</th>
        <th>Departamento</th>
        <th>Metodo de pago</th>
        <th>Usuario</th>
        <th>Monto</th>
    </tr>

    <?php foreach ($gastos as $gasto): ?>
        <tr>
            <td><?= htmlspecialchars($gasto['id_gasto']) ?></td>
            <td><?= htmlspecialchars($gasto['fecha']) ?></td>
            <td><?= htmlspecialchars($gasto['descripcion']) ?></td>
            <td><?= htmlspecialchars($gasto['nombre_categoria']) ?></td>
            <td><?= htmlspecialchars($gasto['nombre_departamento']) ?></td>
            <td><?= htmlspecialchars($gasto['metodo_pago']) ?></td>
            <td><?= htmlspecialchars($gasto['usuario']) ?></td>
            <td><?= htmlspecialchars($gasto['monto']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
