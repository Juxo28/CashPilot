<?php

class Departamento{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM departamento";

        $consulta = $this->connection->query($sql);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

     public function getByid($id_departamento)
    {
        try {
            $sql = "SELECT * FROM departamento WHERE id_departamento = :id_departamento";

            $consulta = $this->connection->prepare($sql);

             $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta->bindParam(":id_departamento", $id_departamento);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de departamento";
        }
    }


    public function crear($nombre_departamento, $descripcion, $presupuesto)
    {
        try {
            $sql = "INSERT INTO departamento (nombre_departamento, descripcion, presupuesto)
                    VALUES (, :nombre_departamento, :descripcion, :presupuesto)";

            $consulta = $this->connection->prepare($sql);

            $consulta->bindParam(":nombre_departamento", $nombre_departamento);
            $consulta->bindParam(":descripcion", $descripcion);
            $consulta->bindParam(":presupuesto", $presupuesto);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo crear de departamento";
        }
    }

    public function guardar($id_empresa, $nombre_departamento, $descripcion, $presupuesto){
    try {
        $sql = "INSERT INTO departamento (id_empresa, nombre_departamento, descripcion, presupuesto)
                VALUES (:id_empresa, :nombre_departamento, :descripcion, :presupuesto)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(":id_empresa", $id_empresa);
        $consulta->bindParam(":nombre_departamento", $nombre_departamento);
        $consulta->bindParam(":descripcion", $descripcion);
        $consulta->bindParam(":presupuesto", $presupuesto);

        return $consulta->execute();
    } catch (PDOException $e) {
        echo "Hay un error en el metodo guardar de departamento";
    }
}
}
