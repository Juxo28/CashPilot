<?php

class Usuario{
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
                INNER JOIN rol ON usuario.id_rol = rol.id_rol";

        $consulta = $this->connection->query($sql);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByid($id_usuario)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";

            $consulta = $this->connection->prepare($sql);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta->bindParam(":id_usuario", $id_usuario);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Hay un error en el metodo getByid de usuario";
        }
    }

    // La contraseña llega en texto plano SOLO hasta aquí: aquí mismo se convierte en hash
    // con password_hash() antes del INSERT, para que en la tabla nunca quede en texto plano.
    public function create($id_empresa, $id_persona, $id_rol, $usuario, $password)
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
            echo "Hay un error en el metodo create de usuario";
        }
    }
}
