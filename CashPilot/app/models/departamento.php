<?php

require_once __DIR__ . "/../../config/Database.php";

class Departamento
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAllByEmpresa($id_empresa)
    {
        $sql = "SELECT id_departamento, nombre_departamento, descripcion, presupuesto
                FROM departamento
                WHERE id_empresa = :id_empresa
                ORDER BY nombre_departamento";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_departamento, $id_empresa)
    {
        $sql = "SELECT id_departamento, nombre_departamento, descripcion, presupuesto
                FROM departamento
                WHERE id_departamento = :id_departamento AND id_empresa = :id_empresa";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_departamento", $id_departamento, PDO::PARAM_INT);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_empresa, $datos)
    {
        $sql = "INSERT INTO departamento (id_empresa, nombre_departamento, descripcion, presupuesto)
                VALUES (:id_empresa, :nombre_departamento, :descripcion, :presupuesto)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->bindValue(":nombre_departamento", $datos['nombre_departamento']);
        $consulta->bindValue(":descripcion", $datos['descripcion'] !== '' ? $datos['descripcion'] : null);
        $consulta->bindValue(":presupuesto", $datos['presupuesto']);   // DECIMAL: se envía como texto '1500000.50'
        $consulta->execute();

        return (int) $this->connection->lastInsertId();
    }
}
