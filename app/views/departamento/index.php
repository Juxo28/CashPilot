<h1>Listado de Departamentos</h1>

<table>
    <tr>
        <th>NOMBRE-DEPARTAMENTO</th>
        <th>DESCRIPCION</th>
        <th>PRESUPUESTO</th>
    </tr>

    <?php foreach ($departamentos as $departamento): ?>
        <tr>
            <td><?= $departamento['nombre_departamento'] ?></td>
            <td><?= $departamento['descripcion'] ?></td>
            <td><?= $departamento['presupuesto'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>