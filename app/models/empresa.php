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

    public function crear($nombre_empresa, $nit, $direccion, $telefono, $correo)
    {
        try {
            $sql = "INSERT INTO empresa (nombre_empresa, nit, direccion, telefono, correo)
                    VALUES (:nombre_empresa, :nit, :direccion, :telefono, :correo)";

            $consulta = $this->connection->prepare($sql);

            $consulta->bindParam(":nombre_empresa", $nombre_empresa);
            $consulta->bindParam(":nit", $nit);
            $consulta->bindParam(":direccion", $direccion);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":correo", $correo);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo create de empresa";
        }
    }
    public function guardar($nombre_empresa,$nit,$direccion,$telefono,$correo){

             try {
            $sql = "INSERT INTO empresa (nombre_empresa, nit, direccion, telefono, correo)
                    VALUES (:nombre_empresa, :nit, :direccion, :telefono, :correo)";

        $consulta = $this->connection->prepare($sql);

            $consulta->bindParam(":nombre_empresa", $nombre_empresa);
            $consulta->bindParam(":nit", $nit);
            $consulta->bindParam(":direccion", $direccion);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":correo", $correo);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo guardar de empresa";
        }

    }
   
}
