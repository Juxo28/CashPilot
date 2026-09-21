<h1>Listado de empresas</h1>

<table>
    <tr>
        <th>Nombre_Empresa</th>
        <th>NIT</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Fecha-Registro</th>
    </tr>

    <?php foreach ($empresas as $empresa): ?>
        <tr>
            <td><?= $empresa['nombre_empresa'] ?></td>
            <td><?= $empresa['nit'] ?></td>
            <td><?= $empresa['direccion'] ?></td>
            <td><?= $empresa['telefono'] ?></td>
            <td><?= $empresa['correo'] ?></td>
            <td><?= $empresa['fecha_registro'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>