<?php

require_once __DIR__ . "/../models/personaModel.php";

class personaController
{
    public function index()
    {
        try {
            $persona = new PersonaModel();
            $personas = $persona->getAll();

            require_once __DIR__ . "/../views/persona/index.php";
        } catch (PDOException $e) {
            echo "Hay un error en el controlador de persona: " . $e->getMessage();
        }
    }

    public function crear()
    {
        require_once __DIR__ . "/../views/persona/crear.php";
    }

    public function guardar()
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        // Si llegan vacios se guardan como NULL (correo es UNIQUE: dos '' chocarian)
        $telefono = $_POST['telefono'] !== '' ? $_POST['telefono'] : null;
        $correo = $_POST['correo'] !== '' ? $_POST['correo'] : null;

        $persona = new PersonaModel();
        if ($persona->guardar($nombre, $apellido, $telefono, $correo)) {
            echo "<p>Persona guardada correctamente</p>";
        } else {
            echo "<p>No se pudo guardar la informacion</p>";
        }

        $this->index();
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        $personaM = new PersonaModel();
        $persona = $personaM->getByid($id);

        if (!$persona) {
            echo "<p>La persona no existe</p>";
            return $this->index();
        }

        require_once __DIR__ . "/../views/persona/editar.php";
    }

    public function actualizar()
    {
        $id = $_POST['id_persona'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'] !== '' ? $_POST['telefono'] : null;
        $correo = $_POST['correo'] !== '' ? $_POST['correo'] : null;

        $persona = new PersonaModel();
        if ($persona->actualizar($id, $nombre, $apellido, $telefono, $correo)) {
            echo "<p>Persona actualizada correctamente</p>";
        }

        return $this->index();
    }

    public function eliminar()
    {
        $id = $_POST['id_persona'];

        try {
            $persona = new PersonaModel();
            $persona->eliminar($id);
            echo "<p>Persona eliminada correctamente</p>";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<p>No se puede eliminar la persona porque tiene un usuario asociado.</p>";
            } else {
                echo "<p>Ocurrió un error al intentar eliminar la persona.</p>";
            }
        }

        return $this->index();
    }
}
