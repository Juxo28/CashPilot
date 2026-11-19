<?php

require_once __DIR__ . "/../../config/database.php";

class Categoria
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
        $sql = "SELECT * FROM categoria ORDER BY tipo_categoria, nombre_categoria";

        $consulta = $this->connection->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Solo las categorias de una empresa (gasto e ingreso solo pueden usar las de su empresa)
    public function getByEmpresa($id_empresa)
    {
        $sql = "SELECT * FROM categoria WHERE id_empresa = :id_empresa ORDER BY nombre_categoria";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(":id_empresa", $id_empresa);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByid($id_categoria)
    {
        try {
            $sql = "SELECT * FROM categoria WHERE id_categoria = :id_categoria";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":id_categoria", $id_categoria);
            $consulta->execute();

            // fetch() devuelve UNA fila; fetchAll() devolveria una lista de filas
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de Categoria: " . $e->getMessage();
            return false;
        }
    }

    public function guardar($id_empresa, $nombre_categoria, $tipo_categoria, $descripcion)
    {
        try {
            // id_categoria NO se envia: MySQL lo genera solo (AUTO_INCREMENT)
            $sql = "INSERT INTO categoria (id_empresa, nombre_categoria, tipo_categoria, descripcion)
                    VALUES (:id_empresa, :nombre_categoria, :tipo_categoria, :descripcion)";

            $consulta = $this->connection->prepare($sql);

            $consulta->bindParam(":id_empresa", $id_empresa);
            $consulta->bindParam(":nombre_categoria", $nombre_categoria);
            $consulta->bindParam(":tipo_categoria", $tipo_categoria);
            $consulta->bindParam(":descripcion", $descripcion);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo guardar de Categoria: " . $e->getMessage();
            return false;
        }
    }

    public function actualizar($id_categoria, $nombre_categoria, $tipo_categoria, $descripcion)
    {
        try {
            // Ojo: NO va coma antes del WHERE
            $sql = "UPDATE categoria
                    SET nombre_categoria = :nombre_categoria,
                        tipo_categoria = :tipo_categoria,
                        descripcion = :descripcion
                    WHERE id_categoria = :id_categoria";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":id_categoria", $id_categoria);
            $consulta->bindParam(":nombre_categoria", $nombre_categoria);
            $consulta->bindParam(":tipo_categoria", $tipo_categoria);
            $consulta->bindParam(":descripcion", $descripcion);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo actualizar de Categoria: " . $e->getMessage();
            return false;
        }
    }

    // No lleva try/catch: el controlador atrapa el error para avisar si tiene gastos/ingresos asociados
    public function eliminar($id_categoria)
    {
        $sql = "DELETE FROM categoria WHERE id_categoria = :id_categoria";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(":id_categoria", $id_categoria);

        return $consulta->execute();
    }
}
