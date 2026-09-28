<h1>Roles</h1>

<p class="acciones"><a class="boton" href="<?= url('/rol/crear') ?>">Nuevo rol</a></p>

<?php if (!empty($roles)) : ?>
    <table>
        <tr><th>ID</th><th>Nombre</th><th>Descripción</th></tr>
        <?php foreach ($roles as $rol) : ?>
            <tr>
                <td><?= e($rol['id_rol']) ?></td>
                <td><?= e($rol['nombre_rol']) ?></td>
                <td><?= e($rol['descripcion']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No hay roles para mostrar.</p>
<?php endif; ?>
