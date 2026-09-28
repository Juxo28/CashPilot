<?php

class PersonaModel{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM persona";

        $consulta = $this->connection->query($sql);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByid($id_persona)
    {
        try {
            $sql = "SELECT * FROM persona WHERE id_persona = :id_persona";

            $consulta = $this->connection->prepare($sql);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta->bindParam(":id_persona", $id_persona);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de persona";
        }
    }

    public function create($nombre, $apellido, $telefono, $correo)
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
            echo "Hay un error en el metodo create de persona";
        }
    }
}
