<?php

class Database
{
    private $host;
    private $port;
    private $nombredb;
    private $user;
    private $password;
    private $connection;

    public function __construct()
    {
        $env = parse_ini_file(__DIR__ . "/../.env");

        $this->host = $env['DB_HOST'];
        $this->port = $env['DB_PORT'];
        $this->nombredb = $env['DB_NAME'];
        $this->user = $env['DB_USER'];
        $this->password = $env['DB_PASSWORD'];
    }

    public function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->nombredb}";

            $this->connection = new PDO($dsn, $this->user, $this->password);
            
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->connection;
        } catch (PDOException $e) {
            echo " Hay un error en la conexion de la base de datos";
        }
    }
}
