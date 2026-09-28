<h1>Departamentos</h1>

<p class="acciones"><a class="boton" href="<?= url('/departamento/crear') ?>">Nuevo departamento</a></p>

<?php if (!empty($departamentos)) : ?>
    <table>
        <tr><th>ID</th><th>Nombre</th><th>Descripción</th><th class="num">Presupuesto</th></tr>
        <?php foreach ($departamentos as $departamento) : ?>
            <tr>
                <td><?= e($departamento['id_departamento']) ?></td>
                <td><?= e($departamento['nombre_departamento']) ?></td>
                <td><?= e($departamento['descripcion']) ?></td>
                <td class="num"><?= e(dinero($departamento['presupuesto'])) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No hay departamentos para mostrar.</p>
<?php endif; ?>
