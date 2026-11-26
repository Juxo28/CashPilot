<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Roles</h1>
    <a class="btn btn-primary" href="<?= url('/rol/crear') ?>">Nuevo rol</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol): ?>
                <tr>
                    <td><?= e($rol['id_rol']) ?></td>
                    <td><?= e($rol['nombre_rol']) ?></td>
                    <td><?= e($rol['descripcion']) ?></td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-outline-warning" href="<?= url('/rol/editar') ?>?id=<?= e($rol['id_rol']) ?>">Editar</a>
                        <form class="d-inline" action="<?= url('/rol/eliminar') ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar: <?= e($rol['nombre_rol']) ?>?')">
                            <input type="hidden" name="id_rol" value="<?= e($rol['id_rol']) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
