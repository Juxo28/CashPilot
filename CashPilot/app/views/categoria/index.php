<h1>Categorías</h1>

<p class="acciones"><a class="boton" href="<?= url('/categoria/crear') ?>">Nueva categoría</a></p>

<?php if (!empty($categorias)) : ?>
    <table>
        <tr><th>ID</th><th>Nombre</th><th>Tipo</th><th>Descripción</th></tr>
        <?php foreach ($categorias as $categoria) : ?>
            <tr>
                <td><?= e($categoria['id_categoria']) ?></td>
                <td><?= e($categoria['nombre_categoria']) ?></td>
                <td><?= e($categoria['tipo_categoria']) ?></td>
                <td><?= e($categoria['descripcion']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No hay categorías para mostrar.</p>
<?php endif; ?>
