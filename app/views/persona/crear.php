<h1>Nueva persona</h1>

<form method="POST" action="<?= url('/persona') ?>">
    <label for="nombre">Nombre</label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="apellido">Apellido</label><br>
    <input type="text" id="apellido" name="apellido" required><br><br>

    <label for="telefono">Telefono</label><br>
    <input type="tel" id="telefono" name="telefono"><br><br>

    <label for="correo">Correo</label><br>
    <input type="email" id="correo" name="correo"><br><br>

    <button type="submit">Guardar</button>
    <a href="<?= url('/persona') ?>">Cancelar</a>
</form>
