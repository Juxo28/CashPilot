<h1> Actualizando Datos</h1>

<form action="/empresa/editar" method="POST">

<input type="hidden" name="id_empresa" value="<?= $empresa["id_empresa"] ?>"><br><br>

<label for="nombre_empresa">Nombre de la Empresa</label>
<input type="text" name="nombre_empresa" value="<?= $empresa["nombre_empresa"]?>" ><br><br>

<label for="nit">Nit</label>
<input type="text" name="nit" value="<?= $empresa["nit"] ?>" ><br><br>

<label for="direccion">Direccion</label>
<input type="text" name="direccion" value="<?= $empresa["direccion"] ?>" ><br><br>

<label for="telefono">Telefono</label>
<input type="tel" name="telefono" value="<?= $empresa["telefono"] ?>" ><br><br>

<label for="correo">Correo</label>
<input type="email" name="correo" value="<?= $empresa["correo"] ?>" ><br><br>


<button type="submit">Guardar</button>

</form> <br>

<h3> Estas seguro que quieres eliminar la empresa?</h3>

<form action="/empresa/eliminar" method="POST">

<input type="hidden" name="id_empresa" value="<?= $empresa["id_empresa"] ?>"><br><br>

<button type="submit">Borrar</button>

</form>