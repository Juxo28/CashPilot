<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Categorías</h1>
    <a class="btn btn-primary" href="<?= url('/categoria/crear') ?>">Nueva categoría</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?= e($categoria['id_categoria']) ?></td>
                    <td><?= e($categoria['nombre_categoria']) ?></td>
                    <td>
                        <?php if ($categoria['tipo_categoria'] === 'ingreso'): ?>
                            <span class="badge text-bg-success">Ingreso</span>
                        <?php else: ?>
                            <span class="badge text-bg-danger">Gasto</span>
                        <?php endif; ?>
                    </td>
                    <td><?= e($categoria['descripcion']) ?></td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-outline-warning" href="<?= url('/categoria/editar') ?>?id=<?= e($categoria['id_categoria']) ?>">Editar</a>
                        <form class="d-inline" action="<?= url('/categoria/eliminar') ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar: <?= e($categoria['nombre_categoria']) ?>?')">
                            <input type="hidden" name="id_categoria" value="<?= e($categoria['id_categoria']) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
