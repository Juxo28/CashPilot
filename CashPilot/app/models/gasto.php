<?php

require_once __DIR__ . "/../../config/Database.php";

class Gasto
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    // Tabla principal: gasto (alias g). Se une con categoria (c), departamento (d) y usuario (u).
    // Cada JOIN relaciona la clave foránea de gasto con la clave primaria de la otra tabla.
    // AS renombra la columna de salida para que la vista use nombres claros.
    public function getAllByEmpresa($id_empresa)
    {
        $sql = "SELECT g.id_gasto,
                       g.fecha,
                       g.descripcion,
                       g.monto,
                       g.metodo_pago,
                       c.nombre_categoria    AS categoria,
                       d.nombre_departamento AS departamento,
                       u.usuario             AS registrado_por
                FROM gasto g
                INNER JOIN categoria    c ON g.id_categoria    = c.id_categoria
                INNER JOIN departamento d ON g.id_departamento = d.id_departamento
                INNER JOIN usuario      u ON g.id_usuario      = u.id_usuario
                WHERE g.id_empresa = :id_empresa
                ORDER BY g.fecha DESC, g.id_gasto DESC";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($id_empresa, $id_usuario, $datos)
    {
        $sql = "INSERT INTO gasto (id_empresa, id_departamento, id_categoria, id_usuario,
                                   monto, fecha, descripcion, metodo_pago, comprobante)
                VALUES (:id_empresa, :id_departamento, :id_categoria, :id_usuario,
                        :monto, :fecha, :descripcion, :metodo_pago, :comprobante)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->bindValue(":id_departamento", $datos['id_departamento'], PDO::PARAM_INT);
        $consulta->bindValue(":id_categoria", $datos['id_categoria'], PDO::PARAM_INT);
        $consulta->bindValue(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(":monto", $datos['monto']);
        $consulta->bindValue(":fecha", $datos['fecha']);
        $consulta->bindValue(":descripcion", $datos['descripcion']);
        $consulta->bindValue(":metodo_pago", $datos['metodo_pago']);
        $consulta->bindValue(":comprobante", $datos['comprobante'] !== '' ? $datos['comprobante'] : null);
        $consulta->execute();

        return (int) $this->connection->lastInsertId();
    }
}
