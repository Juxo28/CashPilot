<?php

class Gasto{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Tabla principal: gasto. Se une con categoria, departamento y usuario para mostrar
    // nombres en vez de solo ids.
    public function getAll()
    {
        $sql = "SELECT gasto.id_gasto, gasto.fecha, gasto.descripcion, gasto.monto, gasto.metodo_pago,
                       categoria.nombre_categoria,
                       departamento.nombre_departamento,
                       usuario.usuario
                FROM gasto
                INNER JOIN categoria ON gasto.id_categoria = categoria.id_categoria
                INNER JOIN departamento ON gasto.id_departamento = departamento.id_departamento
                INNER JOIN usuario ON gasto.id_usuario = usuario.id_usuario";

        $consulta = $this->connection->query($sql);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByid($id_gasto)
    {
        try {
            $sql = "SELECT * FROM gasto WHERE id_gasto = :id_gasto";

            $consulta = $this->connection->prepare($sql);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta->bindParam(":id_gasto", $id_gasto);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de gasto";
        }
    }

    public function create($id_empresa, $id_usuario, $id_departamento, $id_categoria, $monto, $fecha, $descripcion, $metodo_pago, $comprobante)
    {
        try {
            $sql = "INSERT INTO gasto (id_empresa, id_departamento, id_categoria, id_usuario, monto, fecha, descripcion, metodo_pago, comprobante)
                    VALUES (:id_empresa, :id_departamento, :id_categoria, :id_usuario, :monto, :fecha, :descripcion, :metodo_pago, :comprobante)";

            $consulta = $this->connection->prepare($sql);

            $consulta->bindParam(":id_empresa", $id_empresa);
            $consulta->bindParam(":id_departamento", $id_departamento);
            $consulta->bindParam(":id_categoria", $id_categoria);
            $consulta->bindParam(":id_usuario", $id_usuario);
            $consulta->bindParam(":monto", $monto);
            $consulta->bindParam(":fecha", $fecha);
            $consulta->bindParam(":descripcion", $descripcion);
            $consulta->bindParam(":metodo_pago", $metodo_pago);
            $consulta->bindParam(":comprobante", $comprobante);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo create de gasto";
        }
    }
}
