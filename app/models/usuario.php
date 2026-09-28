<?php

require_once __DIR__ . "/../../config/Database.php";

class Usuario
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    // Tabla principal: usuario. Se une con persona (por id_persona) y con rol (por id_rol).
    // NUNCA se selecciona la columna password: una lista no necesita el hash.
    public function getAllByEmpresa($id_empresa)
    {
        $sql = "SELECT usuario.id_usuario,
                       usuario.usuario,
                       persona.nombre,
                       persona.apellido,
                       persona.correo,
                       rol.nombre_rol AS rol,
                       usuario.estado
                FROM usuario
                INNER JOIN persona ON usuario.id_persona = persona.id_persona
                INNER JOIN rol     ON usuario.id_rol     = rol.id_rol
                WHERE usuario.id_empresa = :id_empresa
                ORDER BY usuario.id_usuario";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // La contraseña llega en texto plano SOLO hasta aquí: el modelo la convierte en hash
    // antes de guardarla, así que en la base de datos nunca queda el texto original.
    public function create($id_empresa, $datos)
    {
        $sql = "INSERT INTO usuario (id_empresa, id_persona, id_rol, usuario, password, estado)
                VALUES (:id_empresa, :id_persona, :id_rol, :usuario, :password, 1)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consulta->bindValue(":id_persona", $datos['id_persona'], PDO::PARAM_INT);
        $consulta->bindValue(":id_rol", $datos['id_rol'], PDO::PARAM_INT);
        $consulta->bindValue(":usuario", $datos['usuario']);
        $consulta->bindValue(":password", password_hash($datos['password'], PASSWORD_DEFAULT));
        $consulta->execute();

        return (int) $this->connection->lastInsertId();
    }
}
