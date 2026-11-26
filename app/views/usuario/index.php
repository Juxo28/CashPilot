<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Usuarios</h1>
    <a class="btn btn-primary" href="<?= url('/usuario/crear') ?>">Nuevo usuario</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Rol</th>
                <th>Estado</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= e($usuario['id_usuario']) ?></td>
                    <td><?= e($usuario['usuario']) ?></td>
                    <td><?= e($usuario['nombre']) ?></td>
                    <td><?= e($usuario['apellido']) ?></td>
                    <td><?= e($usuario['nombre_rol']) ?></td>
                    <td>
                        <?php if ($usuario['estado'] == 1): ?>
                            <span class="badge text-bg-success">Activo</span>
                        <?php else: ?>
                            <span class="badge text-bg-secondary">Inactivo</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-outline-warning" href="<?= url('/usuario/editar') ?>?id=<?= e($usuario['id_usuario']) ?>">Editar</a>
                        <form class="d-inline" action="<?= url('/usuario/eliminar') ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar: <?= e($usuario['usuario']) ?>?')">
                            <input type="hidden" name="id_usuario" value="<?= e($usuario['id_usuario']) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
