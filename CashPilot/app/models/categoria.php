<?php

require_once __DIR__ . "/../../config/Database.php";

class Categoria
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAllByEmpresa($id_empresa)
    {
        $sql = "SELECT id_categoria, nombre_categoria, tipo_categoria, descripcion
                FROM categoria
                WHERE id_empresa = :id_empresa
                ORDER BY tipo_categoria, nombre_categoria";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Categorías de un tipo ('ingreso' o 'gasto'). Sirve para llenar los <select> de los formularios.
    public function getByTipo($id_empresa, $tipo)
    {
        $sql = "SELECT id_categoria, nombre_categoria
                FROM categoria
                WHERE id_empresa = :id_empresa AND tipo_categoria = :tipo
                ORDER BY nombre_categoria";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->bindValue(":tipo", $tipo);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Filtra también por empresa: nadie ve categorías ajenas cambiando el id.
    public function getById($id_categoria, $id_empresa)
    {
        $sql = "SELECT id_categoria, nombre_categoria, tipo_categoria, descripcion
                FROM categoria
                WHERE id_categoria = :id_categoria AND id_empresa = :id_empresa";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_categoria", $id_categoria, PDO::PARAM_INT);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_empresa, $datos)
    {
        $sql = "INSERT INTO categoria (id_empresa, nombre_categoria, tipo_categoria, descripcion)
                VALUES (:id_empresa, :nombre_categoria, :tipo_categoria, :descripcion)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->bindValue(":nombre_categoria", $datos['nombre_categoria']);
        $consulta->bindValue(":tipo_categoria", $datos['tipo_categoria']);
        $consulta->bindValue(":descripcion", $datos['descripcion'] !== '' ? $datos['descripcion'] : null);
        $consulta->execute();

        return (int) $this->connection->lastInsertId();
    }
}
