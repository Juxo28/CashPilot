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
        <th></th>
        <th></th>
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
            <td><a href="/gasto/editar?id=<?= $gasto['id_gasto'] ?>">Editar</a></td>
            <td>
                <form action="/gasto/eliminar" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar: <?= htmlspecialchars($gasto['descripcion'], ENT_QUOTES) ?>?')">
                    <input type="hidden" name="id_gasto" value="<?= $gasto['id_gasto'] ?>">
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
