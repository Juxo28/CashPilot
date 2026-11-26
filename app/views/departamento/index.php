<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Departamentos</h1>
    <a class="btn btn-primary" href="<?= url('/departamento/crear') ?>">Nuevo departamento</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th class="text-end">Presupuesto</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departamentos as $departamento): ?>
                <tr>
                    <td><?= e($departamento['id_departamento']) ?></td>
                    <td><?= e($departamento['nombre_departamento']) ?></td>
                    <td><?= e($departamento['descripcion']) ?></td>
                    <td class="text-end"><?= dinero($departamento['presupuesto']) ?></td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-outline-warning" href="<?= url('/departamento/editar') ?>?id=<?= e($departamento['id_departamento']) ?>">Editar</a>
                        <form class="d-inline" action="<?= url('/departamento/eliminar') ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar: <?= e($departamento['nombre_departamento']) ?>?')">
                            <input type="hidden" name="id_departamento" value="<?= e($departamento['id_departamento']) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
