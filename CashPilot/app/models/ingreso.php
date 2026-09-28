<?php

class Ingreso{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAll()
    {
        $sql = "SELECT ingreso.id_ingreso, ingreso.fecha, ingreso.descripcion, ingreso.monto, ingreso.fuente,
                       categoria.nombre_categoria,
                       usuario.usuario
                FROM ingreso
                INNER JOIN categoria ON ingreso.id_categoria = categoria.id_categoria
                INNER JOIN usuario ON ingreso.id_usuario = usuario.id_usuario";

        $consulta = $this->connection->query($sql);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByid($id_ingreso)
    {
        try {
            $sql = "SELECT * FROM ingreso WHERE id_ingreso = :id_ingreso";

            $consulta = $this->connection->prepare($sql);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta->bindParam(":id_ingreso", $id_ingreso);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de ingreso";
        }
    }

    public function create($id_empresa, $id_usuario, $id_categoria, $monto, $fecha, $descripcion, $fuente)
    {
        try {
            $sql = "INSERT INTO ingreso (id_empresa, id_categoria, id_usuario, monto, fecha, descripcion, fuente)
                    VALUES (:id_empresa, :id_categoria, :id_usuario, :monto, :fecha, :descripcion, :fuente)";

            $consulta = $this->connection->prepare($sql);

            $consulta->bindParam(":id_empresa", $id_empresa);
            $consulta->bindParam(":id_categoria", $id_categoria);
            $consulta->bindParam(":id_usuario", $id_usuario);
            $consulta->bindParam(":monto", $monto);
            $consulta->bindParam(":fecha", $fecha);
            $consulta->bindParam(":descripcion", $descripcion);
            $consulta->bindParam(":fuente", $fuente);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo create de ingreso";
        }
    }
}
