<h1>Listado de departamentos</h1>

<a href="/departamento/crear">Nuevo departamento</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Presupuesto</th>
    </tr>

    <?php foreach ($departamentos as $departamento): ?>
        <tr>
            <td><?= htmlspecialchars($departamento['id_departamento']) ?></td>
            <td><?= htmlspecialchars($departamento['nombre_departamento']) ?></td>
            <td><?= htmlspecialchars($departamento['descripcion']) ?></td>
            <td><?= htmlspecialchars($departamento['presupuesto']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
