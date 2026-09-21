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

}