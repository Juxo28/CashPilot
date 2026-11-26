<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Personas</h1>
    <a class="btn btn-primary" href="<?= url('/persona/crear') ?>">Nueva persona</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personas as $persona): ?>
                <tr>
                    <td><?= e($persona['id_persona']) ?></td>
                    <td><?= e($persona['nombre']) ?></td>
                    <td><?= e($persona['apellido']) ?></td>
                    <td><?= e($persona['telefono']) ?></td>
                    <td><?= e($persona['correo']) ?></td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-outline-warning" href="<?= url('/persona/editar') ?>?id=<?= e($persona['id_persona']) ?>">Editar</a>
                        <form class="d-inline" action="<?= url('/persona/eliminar') ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar: <?= e($persona['nombre'] . ' ' . $persona['apellido']) ?>?')">
                            <input type="hidden" name="id_persona" value="<?= e($persona['id_persona']) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
