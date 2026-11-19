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
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($ingresos as $ingreso): ?>
        <tr>
            <td><?= htmlspecialchars($ingreso['id_ingreso']) ?></td>
            <td><?= htmlspecialchars($ingreso['fecha']) ?></td>
            <td><?= htmlspecialchars($ingreso['descripcion']) ?></td>
            <td><?= htmlspecialchars($ingreso['nombre_categoria']) ?></td>
            <td><?= htmlspecialchars($ingreso['fuente'] ?? '') ?></td>
            <td><?= htmlspecialchars($ingreso['usuario']) ?></td>
            <td><?= htmlspecialchars($ingreso['monto']) ?></td>
            <td><a href="/ingreso/editar?id=<?= $ingreso['id_ingreso'] ?>">Editar</a></td>
            <td>
                <form action="/ingreso/eliminar" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar: <?= htmlspecialchars($ingreso['descripcion'], ENT_QUOTES) ?>?')">
                    <input type="hidden" name="id_ingreso" value="<?= $ingreso['id_ingreso'] ?>">
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
