<h1>Gastos</h1>

<p class="acciones"><a class="boton" href="<?= url('/gasto/crear') ?>">Nuevo gasto</a></p>

<?php if (!empty($gastos)) : ?>
    <table>
        <tr>
            <th>ID</th><th>Fecha</th><th>Descripción</th><th>Categoría</th><th>Departamento</th>
            <th>Método</th><th>Registrado por</th><th class="num">Monto</th>
        </tr>
        <?php foreach ($gastos as $gasto) : ?>
            <tr>
                <td><?= e($gasto['id_gasto']) ?></td>
                <td><?= e($gasto['fecha']) ?></td>
                <td><?= e($gasto['descripcion']) ?></td>
                <td><?= e($gasto['categoria']) ?></td>
                <td><?= e($gasto['departamento']) ?></td>
                <td><?= e($gasto['metodo_pago']) ?></td>
                <td><?= e($gasto['registrado_por']) ?></td>
                <td class="num"><?= e(dinero($gasto['monto'])) ?></td>
            </tr>
        <?php endforeach; ?>
        <tfoot>
            <tr>
                <td colspan="7">Total de gastos</td>
                <td class="num"><?= e(dinero(array_sum(array_column($gastos, 'monto')))) ?></td>
            </tr>
        </tfoot>
    </table>
<?php else : ?>
    <p>No hay gastos para mostrar.</p>
<?php endif; ?>
