<?php

require_once __DIR__ . "/../../config/database.php";

class Departamento
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
        $sql = "SELECT * FROM departamento ORDER BY nombre_departamento";

        $consulta = $this->connection->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Solo los departamentos de una empresa (un gasto solo puede usar los de su empresa)
    public function getByEmpresa($id_empresa)
    {
        $sql = "SELECT * FROM departamento WHERE id_empresa = :id_empresa ORDER BY nombre_departamento";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(":id_empresa", $id_empresa);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByid($id_departamento)
    {
        try {
            $sql = "SELECT * FROM departamento WHERE id_departamento = :id_departamento";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":id_departamento", $id_departamento);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de departamento: " . $e->getMessage();
            return false;
        }
    }

    public function guardar($id_empresa, $nombre_departamento, $descripcion, $presupuesto)
    {
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
            echo "Hay un error en el metodo guardar de departamento: " . $e->getMessage();
            return false;
        }
    }

    public function actualizar($id_departamento, $nombre_departamento, $descripcion, $presupuesto)
    {
        try {
            $sql = "UPDATE departamento
                    SET nombre_departamento = :nombre_departamento,
                        descripcion = :descripcion,
                        presupuesto = :presupuesto
                    WHERE id_departamento = :id_departamento";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":id_departamento", $id_departamento);
            $consulta->bindParam(":nombre_departamento", $nombre_departamento);
            $consulta->bindParam(":descripcion", $descripcion);
            $consulta->bindParam(":presupuesto", $presupuesto);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo actualizar de departamento: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($id_departamento)
    {
        $sql = "DELETE FROM departamento WHERE id_departamento = :id_departamento";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(":id_departamento", $id_departamento);

        return $consulta->execute();
    }
}
