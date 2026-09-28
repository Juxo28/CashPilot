<h1>Empresas</h1>

<p class="acciones"><a class="boton" href="<?= url('/empresa/crear') ?>">Nueva empresa</a></p>

<?php if (!empty($empresas)) : ?>
    <table>
        <tr>
            <th>ID</th><th>Nombre</th><th>NIT</th><th>Dirección</th><th>Teléfono</th><th>Correo</th><th>Registrada</th>
        </tr>
        <?php foreach ($empresas as $empresa) : ?>
            <tr>
                <td><?= e($empresa['id_empresa']) ?></td>
                <td><?= e($empresa['nombre_empresa']) ?></td>
                <td><?= e($empresa['nit']) ?></td>
                <td><?= e($empresa['direccion']) ?></td>
                <td><?= e($empresa['telefono']) ?></td>
                <td><?= e($empresa['correo']) ?></td>
                <td><?= e($empresa['fecha_registro']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No hay empresas para mostrar.</p>
<?php endif; ?>
