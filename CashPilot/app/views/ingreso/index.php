<h1>Ingresos</h1>

<p class="acciones"><a class="boton" href="<?= url('/ingreso/crear') ?>">Nuevo ingreso</a></p>

<?php if (!empty($ingresos)) : ?>
    <table>
        <tr>
            <th>ID</th><th>Fecha</th><th>Descripción</th><th>Categoría</th><th>Fuente</th>
            <th>Registrado por</th><th class="num">Monto</th>
        </tr>
        <?php foreach ($ingresos as $ingreso) : ?>
            <tr>
                <td><?= e($ingreso['id_ingreso']) ?></td>
                <td><?= e($ingreso['fecha']) ?></td>
                <td><?= e($ingreso['descripcion']) ?></td>
                <td><?= e($ingreso['categoria']) ?></td>
                <td><?= e($ingreso['fuente']) ?></td>
                <td><?= e($ingreso['registrado_por']) ?></td>
                <td class="num"><?= e(dinero($ingreso['monto'])) ?></td>
            </tr>
        <?php endforeach; ?>
        <tfoot>
            <tr>
                <td colspan="6">Total de ingresos</td>
                <td class="num"><?= e(dinero(array_sum(array_column($ingresos, 'monto')))) ?></td>
            </tr>
        </tfoot>
    </table>
<?php else : ?>
    <p>No hay ingresos para mostrar.</p>
<?php endif; ?>
