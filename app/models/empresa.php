<?php

require_once __DIR__ . "/../../config/Database.php";

class Empresa
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAll()
    {
        $sql = "SELECT id_empresa, nombre_empresa, nit, direccion, telefono, correo, fecha_registro
            FROM empresa
            ORDER BY nombre_empresa";

        $consulta = $this->connection->query($sql);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }


     public function getByid($id_empresa)
    {
        try {
            $sql = "SELECT * FROM empresa WHERE id_empresa = :id_empresa";

            $consulta = $this->connection->prepare($sql);

             $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta->bindParam(":id_empresa", $id_empresa);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de empresa";
        }
    }
}
