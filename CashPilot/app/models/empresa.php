<?php

require_once __DIR__ . "/../../config/Database.php";

class Empresa
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    // Lista todas las empresas. No recibe valores externos, por eso basta query().
    public function getAll()
    {
        $sql = "SELECT id_empresa, nombre_empresa, nit, direccion, telefono, correo, fecha_registro
                FROM empresa
                ORDER BY nombre_empresa";

        $consulta = $this->connection->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Devuelve UNA fila (array) o false si no existe.
    public function getById($id_empresa)
    {
        $sql = "SELECT id_empresa, nombre_empresa, nit, direccion, telefono, correo, fecha_registro
                FROM empresa
                WHERE id_empresa = :id_empresa";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Inserta una empresa. Los campos opcionales vacíos se guardan como NULL.
    public function create($datos)
    {
        $sql = "INSERT INTO empresa (nombre_empresa, nit, direccion, telefono, correo)
                VALUES (:nombre_empresa, :nit, :direccion, :telefono, :correo)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":nombre_empresa", $datos['nombre_empresa']);
        $consulta->bindValue(":nit", $datos['nit']);
        $consulta->bindValue(":direccion", $datos['direccion'] !== '' ? $datos['direccion'] : null);
        $consulta->bindValue(":telefono", $datos['telefono'] !== '' ? $datos['telefono'] : null);
        $consulta->bindValue(":correo", $datos['correo'] !== '' ? $datos['correo'] : null);
        $consulta->execute();

        return (int) $this->connection->lastInsertId();
    }
}
