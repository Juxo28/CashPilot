<h1>Listado de empresas</h1>

<a href="empresa/crear">Crear nueva empresa </a>


<table border="1" cellpadding="6">
    <tr>
        <th>Nombre_Empresa</th>
        <th>NIT</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Fecha-Registro</th>
        <th></th>
    </tr>

    <?php foreach ($empresas as $empresa): ?>
        <tr>
            <td><?= $empresa['nombre_empresa'] ?></td>
            <td><?= $empresa['nit'] ?></td>
            <td><?= $empresa['direccion'] ?></td>
            <td><?= $empresa['telefono'] ?></td>
            <td><?= $empresa['correo'] ?></td>
            <td><?= $empresa['fecha_registro'] ?></td>
            <td><a href="/empresa/editar?id=<?= $empresa['id_empresa'] ?>">Editar</a></td>
            <td>
                <form action="/empresa/eliminar" method="POST">

                    <input type="hidden" name="id_empresa" value="<?= $empresa["id_empresa"] ?>"><br><br>

                    <button type="submit">Borrar</button>

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>