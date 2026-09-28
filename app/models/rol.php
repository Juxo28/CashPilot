<?php

require_once __DIR__ . "/../../config/Database.php";

class Rol
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    // Los roles son globales (la tabla no tiene id_empresa), por eso no se filtra por empresa.
    public function getAll()
    {
        $sql = "SELECT id_rol, nombre_rol, descripcion
                FROM rol
                ORDER BY id_rol";

        $consulta = $this->connection->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_rol)
    {
        $sql = "SELECT id_rol, nombre_rol, descripcion
                FROM rol
                WHERE id_rol = :id_rol";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_rol", $id_rol, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($datos)
    {
        $sql = "INSERT INTO rol (nombre_rol, descripcion)
                VALUES (:nombre_rol, :descripcion)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":nombre_rol", $datos['nombre_rol']);
        $consulta->bindValue(":descripcion", $datos['descripcion'] !== '' ? $datos['descripcion'] : null);
        $consulta->execute();

        return (int) $this->connection->lastInsertId();
    }
}
