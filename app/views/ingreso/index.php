<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Ingresos</h1>
    <a class="btn btn-primary" href="<?= url('/ingreso/crear') ?>">Nuevo ingreso</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Fuente</th>
                <th>Usuario</th>
                <th class="text-end">Monto</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ingresos as $ingreso): ?>
                <tr>
                    <td><?= e($ingreso['id_ingreso']) ?></td>
                    <td><?= e($ingreso['fecha']) ?></td>
                    <td><?= e($ingreso['descripcion']) ?></td>
                    <td><?= e($ingreso['nombre_categoria']) ?></td>
                    <td><?= e($ingreso['fuente']) ?></td>
                    <td><?= e($ingreso['usuario']) ?></td>
                    <td class="text-end"><?= dinero($ingreso['monto']) ?></td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-outline-warning" href="<?= url('/ingreso/editar') ?>?id=<?= e($ingreso['id_ingreso']) ?>">Editar</a>
                        <form class="d-inline" action="<?= url('/ingreso/eliminar') ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar: <?= e($ingreso['descripcion']) ?>?')">
                            <input type="hidden" name="id_ingreso" value="<?= e($ingreso['id_ingreso']) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
