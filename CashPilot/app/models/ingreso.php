<?php

require_once __DIR__ . "/../../config/Database.php";

class Ingreso
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAllByEmpresa($id_empresa)
    {
        $sql = "SELECT i.id_ingreso,
                       i.fecha,
                       i.descripcion,
                       i.monto,
                       i.fuente,
                       c.nombre_categoria AS categoria,
                       u.usuario          AS registrado_por
                FROM ingreso i
                INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                INNER JOIN usuario   u ON i.id_usuario   = u.id_usuario
                WHERE i.id_empresa = :id_empresa
                ORDER BY i.fecha DESC, i.id_ingreso DESC";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($id_empresa, $id_usuario, $datos)
    {
        $sql = "INSERT INTO ingreso (id_empresa, id_categoria, id_usuario, monto, fecha, descripcion, fuente)
                VALUES (:id_empresa, :id_categoria, :id_usuario, :monto, :fecha, :descripcion, :fuente)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->bindValue(":id_categoria", $datos['id_categoria'], PDO::PARAM_INT);
        $consulta->bindValue(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(":monto", $datos['monto']);
        $consulta->bindValue(":fecha", $datos['fecha']);
        $consulta->bindValue(":descripcion", $datos['descripcion']);
        $consulta->bindValue(":fuente", $datos['fuente'] !== '' ? $datos['fuente'] : null);
        $consulta->execute();

        return (int) $this->connection->lastInsertId();
    }
}
