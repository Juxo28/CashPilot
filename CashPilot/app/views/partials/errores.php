<?php if (!empty($errores)) : ?>
    <div class="error">
        <strong>Revisa lo siguiente:</strong>
        <ul>
            <?php foreach ($errores as $error) : ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
