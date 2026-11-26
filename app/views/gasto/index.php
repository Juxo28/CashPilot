<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Gastos</h1>
    <a class="btn btn-primary" href="<?= url('/gasto/crear') ?>">Nuevo gasto</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Departamento</th>
                <th>Método de pago</th>
                <th>Usuario</th>
                <th class="text-end">Monto</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gastos as $gasto): ?>
                <tr>
                    <td><?= e($gasto['id_gasto']) ?></td>
                    <td><?= e($gasto['fecha']) ?></td>
                    <td><?= e($gasto['descripcion']) ?></td>
                    <td><?= e($gasto['nombre_categoria']) ?></td>
                    <td><?= e($gasto['nombre_departamento']) ?></td>
                    <td><?= e($gasto['metodo_pago']) ?></td>
                    <td><?= e($gasto['usuario']) ?></td>
                    <td class="text-end"><?= dinero($gasto['monto']) ?></td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-outline-warning" href="<?= url('/gasto/editar') ?>?id=<?= e($gasto['id_gasto']) ?>">Editar</a>
                        <form class="d-inline" action="<?= url('/gasto/eliminar') ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar: <?= e($gasto['descripcion']) ?>?')">
                            <input type="hidden" name="id_gasto" value="<?= e($gasto['id_gasto']) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
