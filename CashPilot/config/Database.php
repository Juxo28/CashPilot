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

        if ($env === false) {
            throw new Exception("No se encontró el archivo .env (copia .env.example y ajústalo).");
        }

        $this->host     = $env['DB_HOST'];
        $this->port     = $env['DB_PORT'];
        $this->nombredb = $env['DB_NAME'];
        $this->user     = $env['DB_USER'];
        $this->password = $env['DB_PASSWORD'];
    }

    // Sin try/catch: si la conexión falla, la PDOException sube hasta el controlador.
    public function connect()
    {
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->nombredb};charset=utf8mb4";

        $this->connection = new PDO($dsn, $this->user, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->connection;
    }
}
