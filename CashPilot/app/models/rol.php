<?php

class Rol{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM rol";

        $consulta = $this->connection->query($sql);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByid($id_rol)
    {
        try {
            $sql = "SELECT * FROM rol WHERE id_rol = :id_rol";

            $consulta = $this->connection->prepare($sql);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta->bindParam(":id_rol", $id_rol);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de rol";
        }
    }

    public function create($nombre_rol, $descripcion)
    {
        try {
            $sql = "INSERT INTO rol (nombre_rol, descripcion) VALUES (:nombre_rol, :descripcion)";

            $consulta = $this->connection->prepare($sql);

            $consulta->bindParam(":nombre_rol", $nombre_rol);
            $consulta->bindParam(":descripcion", $descripcion);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo create de rol";
        }
    }
}
