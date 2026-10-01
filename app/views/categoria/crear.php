<h1>Nueva categoria</h1>

<form method="POST" action="/categoria/guardar">
    <label for="nombre_categoria">Nombre:</label><br>
    <input type="text" id="nombre_categoria" name="nombre_categoria"><br><br>

    <label for="tipo_categoria">Tipo:</label><br>
    <select id="tipo_categoria" name="tipo_categoria">
        <option value="ingreso">Ingreso</option>
        <option value="gasto">Gasto</option>
    </select><br><br>

    <label for="descripcion">Descripcion:</label><br>
    <input type="text" id="descripcion" name="descripcion"><br><br>

    <button type="submit">Guardar</button>
</form>