<?php

require_once __DIR__ . "/../../config/database.php";

class PersonaModel
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM persona ORDER BY nombre, apellido";

        $consulta = $this->connection->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Personas que todavia no tienen usuario (cada persona solo puede tener uno).
    // $id_persona_actual permite incluir a la persona del usuario que se esta editando.
    public function getSinUsuario($id_persona_actual = 0)
    {
        $sql = "SELECT * FROM persona
                WHERE id_persona NOT IN (SELECT id_persona FROM usuario)
                   OR id_persona = :id_persona_actual
                ORDER BY nombre, apellido";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(":id_persona_actual", $id_persona_actual);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByid($id_persona)
    {
        try {
            $sql = "SELECT * FROM persona WHERE id_persona = :id_persona";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":id_persona", $id_persona);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de persona: " . $e->getMessage();
            return false;
        }
    }

    public function guardar($nombre, $apellido, $telefono, $correo)
    {
        try {
            $sql = "INSERT INTO persona (nombre, apellido, telefono, correo)
                    VALUES (:nombre, :apellido, :telefono, :correo)";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":apellido", $apellido);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":correo", $correo);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo guardar de persona: " . $e->getMessage();
            return false;
        }
    }

    public function actualizar($id_persona, $nombre, $apellido, $telefono, $correo)
    {
        try {
            $sql = "UPDATE persona
                    SET nombre = :nombre,
                        apellido = :apellido,
                        telefono = :telefono,
                        correo = :correo
                    WHERE id_persona = :id_persona";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":id_persona", $id_persona);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":apellido", $apellido);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":correo", $correo);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo actualizar de persona: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($id_persona)
    {
        $sql = "DELETE FROM persona WHERE id_persona = :id_persona";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(":id_persona", $id_persona);

        return $consulta->execute();
    }
}
