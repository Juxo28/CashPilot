<h1>Personas</h1>

<p class="acciones"><a class="boton" href="<?= url('/persona/crear') ?>">Nueva persona</a></p>

<?php if (!empty($personas)) : ?>
    <table>
        <tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Correo</th></tr>
        <?php foreach ($personas as $persona) : ?>
            <tr>
                <td><?= e($persona['id_persona']) ?></td>
                <td><?= e($persona['nombre']) ?></td>
                <td><?= e($persona['apellido']) ?></td>
                <td><?= e($persona['telefono']) ?></td>
                <td><?= e($persona['correo']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No hay personas para mostrar.</p>
<?php endif; ?>
