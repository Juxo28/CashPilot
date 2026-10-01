<h1>Nueva categoria</h1>

<form method="GET" action="/categoria/guardar">
    Nombre:<br>
    <input type="text" name="nombre_categoria"><br><br>

    Tipo:<br>
    <select name="tipo_categoria">
        <option value="ingreso">Ingreso</option>
        <option value="gasto">Gasto</option>
    </select><br><br>

    Descripcion:<br>
    <input type="text" name="descripcion"><br><br>

    <button type="submit">Guardar</button>
</form>
