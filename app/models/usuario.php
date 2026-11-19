<?php

require_once __DIR__ . "/../../config/database.php";

class Usuario
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // JOIN con persona y rol para no mostrar solo ids en la lista.
    public function getAll()
    {
        $sql = "SELECT usuario.id_usuario, usuario.usuario, usuario.estado,
                       persona.nombre, persona.apellido,
                       rol.nombre_rol
                FROM usuario
                INNER JOIN persona ON usuario.id_persona = persona.id_persona
                INNER JOIN rol ON usuario.id_rol = rol.id_rol
                ORDER BY usuario.id_usuario";

        $consulta = $this->connection->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByid($id_usuario)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":id_usuario", $id_usuario);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de usuario: " . $e->getMessage();
            return false;
        }
    }

    // La contraseña llega en texto plano SOLO hasta aquí: aquí mismo se convierte en hash
    // con password_hash() antes del INSERT, para que en la tabla nunca quede en texto plano.
    public function guardar($id_empresa, $id_persona, $id_rol, $usuario, $password)
    {
        try {
            $passwordHasheada = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuario (id_empresa, id_persona, id_rol, usuario, password, estado)
                    VALUES (:id_empresa, :id_persona, :id_rol, :usuario, :password, 1)";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":id_empresa", $id_empresa);
            $consulta->bindParam(":id_persona", $id_persona);
            $consulta->bindParam(":id_rol", $id_rol);
            $consulta->bindParam(":usuario", $usuario);
            $consulta->bindParam(":password", $passwordHasheada);

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo guardar de usuario: " . $e->getMessage();
            return false;
        }
    }

    // Si $password llega vacio, se conserva la contraseña actual.
    public function actualizar($id_usuario, $id_persona, $id_rol, $usuario, $estado, $password)
    {
        try {
            $sql = "UPDATE usuario
                    SET id_persona = :id_persona,
                        id_rol = :id_rol,
                        usuario = :usuario,
                        estado = :estado";

            if ($password !== '') {
                $sql .= ", password = :password";
            }

            $sql .= " WHERE id_usuario = :id_usuario";

            $consulta = $this->connection->prepare($sql);
            $consulta->bindParam(":id_usuario", $id_usuario);
            $consulta->bindParam(":id_persona", $id_persona);
            $consulta->bindParam(":id_rol", $id_rol);
            $consulta->bindParam(":usuario", $usuario);
            $consulta->bindParam(":estado", $estado);

            if ($password !== '') {
                $passwordHasheada = password_hash($password, PASSWORD_DEFAULT);
                $consulta->bindParam(":password", $passwordHasheada);
            }

            return $consulta->execute();
        } catch (PDOException $e) {
            echo "Hay un error en el metodo actualizar de usuario: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($id_usuario)
    {
        $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(":id_usuario", $id_usuario);

        return $consulta->execute();
    }
}
