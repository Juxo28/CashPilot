<h1>Listado de personas</h1>

<a href="/persona/crear">Nueva persona</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>Correo</th>
    </tr>

    <?php foreach ($personas as $persona): ?>
        <tr>
            <td><?= htmlspecialchars($persona['id_persona']) ?></td>
            <td><?= htmlspecialchars($persona['nombre']) ?></td>
            <td><?= htmlspecialchars($persona['apellido']) ?></td>
            <td><?= htmlspecialchars($persona['telefono']) ?></td>
            <td><?= htmlspecialchars($persona['correo']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
