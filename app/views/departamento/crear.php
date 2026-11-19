<h1>Nuevo departamento</h1>

<form method="POST" action="/departamento">
    <label for="nombre_departamento">Nombre</label><br>
    <input type="text" id="nombre_departamento" name="nombre_departamento" required><br><br>

    <label for="descripcion">Descripcion</label><br>
    <input type="text" id="descripcion" name="descripcion"><br><br>

    <label for="presupuesto">Presupuesto</label><br>
    <input type="number" id="presupuesto" name="presupuesto" min="0" step="0.01" value="0" required><br><br>

    <button type="submit">Guardar</button>
    <a href="/departamento">Cancelar</a>
</form>
