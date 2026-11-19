<?php

require_once __DIR__ . "/../models/usuario.php";
require_once __DIR__ . "/../models/personaModel.php";
require_once __DIR__ . "/../models/rol.php";

class usuarioController
{
    public function index()
    {
        try {
            $usuario = new Usuario();
            $usuarios = $usuario->getAll();

            require_once __DIR__ . "/../views/usuario/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de usuario: " . $e->getMessage();
        }
    }

    public function crear()
    {
        try {
            $personaModel = new PersonaModel();
            $rolModel = new Rol();

            // Solo personas sin usuario: cada persona puede tener un solo usuario
            $personas = $personaModel->getSinUsuario();
            $roles = $rolModel->getAll();

            require_once __DIR__ . "/../views/usuario/crear.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de usuario al mostrar el formulario: " . $e->getMessage();
        }
    }

    public function guardar()
    {
        $id_empresa = 1; // temporal, hasta que exista el login

        $id_persona = $_POST['id_persona'];
        $id_rol = $_POST['id_rol'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $usuarioM = new Usuario();
        if ($usuarioM->guardar($id_empresa, $id_persona, $id_rol, $usuario, $password)) {
            echo "<p>Usuario guardado correctamente</p>";
        } else {
            echo "<p>No se pudo guardar la informacion</p>";
        }

        $this->index();
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        try {
            $usuarioM = new Usuario();
            $usuario = $usuarioM->getByid($id);

            if (!$usuario) {
                echo "<p>El usuario no existe</p>";
                return $this->index();
            }

            $personaModel = new PersonaModel();
            $rolModel = new Rol();

            $personas = $personaModel->getSinUsuario($usuario['id_persona']);
            $roles = $rolModel->getAll();

            require_once __DIR__ . "/../views/usuario/editar.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de usuario al editar: " . $e->getMessage();
        }
    }

    public function actualizar()
    {
        $id = $_POST['id_usuario'];
        $id_persona = $_POST['id_persona'];
        $id_rol = $_POST['id_rol'];
        $usuario = $_POST['usuario'];
        $estado = $_POST['estado'];
        $password = $_POST['password']; // vacio = no cambiar la contraseña

        $usuarioM = new Usuario();
        if ($usuarioM->actualizar($id, $id_persona, $id_rol, $usuario, $estado, $password)) {
            echo "<p>Usuario actualizado correctamente</p>";
        }

        return $this->index();
    }

    public function eliminar()
    {
        $id = $_POST['id_usuario'];

        try {
            $usuario = new Usuario();
            $usuario->eliminar($id);
            echo "<p>Usuario eliminado correctamente</p>";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<p>No se puede eliminar el usuario porque tiene gastos, ingresos u otros registros asociados. Puedes desactivarlo desde Editar.</p>";
            } else {
                echo "<p>Ocurrió un error al intentar eliminar el usuario.</p>";
            }
        }

        return $this->index();
    }
}
