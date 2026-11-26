<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Empresas</h1>
    <a class="btn btn-primary" href="<?= url('/empresa/crear') ?>">Nueva empresa</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>NIT</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Fecha de registro</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empresas as $empresa): ?>
                <tr>
                    <td><?= e($empresa['nombre_empresa']) ?></td>
                    <td><?= e($empresa['nit']) ?></td>
                    <td><?= e($empresa['direccion']) ?></td>
                    <td><?= e($empresa['telefono']) ?></td>
                    <td><?= e($empresa['correo']) ?></td>
                    <td><?= e($empresa['fecha_registro']) ?></td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-outline-warning" href="<?= url('/empresa/editar') ?>?id=<?= e($empresa['id_empresa']) ?>">Editar</a>
                        <form class="d-inline" action="<?= url('/empresa/eliminar') ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar: <?= e($empresa['nombre_empresa']) ?>?')">
                            <input type="hidden" name="id_empresa" value="<?= e($empresa['id_empresa']) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
