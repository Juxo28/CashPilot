<?php

require_once __DIR__ . "/../../config/Database.php";

// Se llama PersonaModel (y no Persona) porque en class/Persona.php ya existe una clase Persona.
// PHP no permite dos clases con el mismo nombre en la misma ejecución.
class PersonaModel
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAll()
    {
        $sql = "SELECT id_persona, nombre, apellido, telefono, correo
                FROM persona
                ORDER BY apellido, nombre";

        $consulta = $this->connection->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Personas que TODAVÍA no tienen cuenta de usuario (para el formulario de usuarios).
    // LEFT JOIN conserva todas las personas; donde no hay usuario, usuario.id_usuario queda NULL.
    public function getSinUsuario()
    {
        $sql = "SELECT persona.id_persona, persona.nombre, persona.apellido
                FROM persona
                LEFT JOIN usuario ON usuario.id_persona = persona.id_persona
                WHERE usuario.id_usuario IS NULL
                ORDER BY persona.apellido, persona.nombre";

        $consulta = $this->connection->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_persona)
    {
        $sql = "SELECT id_persona, nombre, apellido, telefono, correo
                FROM persona
                WHERE id_persona = :id_persona";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_persona", $id_persona, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($datos)
    {
        $sql = "INSERT INTO persona (nombre, apellido, telefono, correo)
                VALUES (:nombre, :apellido, :telefono, :correo)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":nombre", $datos['nombre']);
        $consulta->bindValue(":apellido", $datos['apellido']);
        $consulta->bindValue(":telefono", $datos['telefono'] !== '' ? $datos['telefono'] : null);
        $consulta->bindValue(":correo", $datos['correo'] !== '' ? $datos['correo'] : null);
        $consulta->execute();

        return (int) $this->connection->lastInsertId();
    }
}
