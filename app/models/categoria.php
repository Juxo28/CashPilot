<?php

class Categoria{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categoria";

        $consulta = $this->connection->query($sql);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

     public function getByid($id_categoria)
    {
        try {
            $sql = "SELECT * FROM categoria WHERE id_categoria = :id_categoria";

            $consulta = $this->connection->prepare($sql);

             $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta->bindParam(":id_categoria", $id_categoria);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de Categoria";
        }
    }

}