<h1>Listado de empresas</h1>

<a href="/empresa/crear">Nueva empresa</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre_Empresa</th>
        <th>NIT</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Fecha-Registro</th>
    </tr>

    <?php foreach ($empresas as $empresa): ?>
        <tr>
            <td><?= htmlspecialchars($empresa['id_empresa']) ?></td>
            <td><?= htmlspecialchars($empresa['nombre_empresa']) ?></td>
            <td><?= htmlspecialchars($empresa['nit']) ?></td>
            <td><?= htmlspecialchars($empresa['direccion']) ?></td>
            <td><?= htmlspecialchars($empresa['telefono']) ?></td>
            <td><?= htmlspecialchars($empresa['correo']) ?></td>
            <td><?= htmlspecialchars($empresa['fecha_registro']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
