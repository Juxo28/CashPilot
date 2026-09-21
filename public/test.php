<?php
require_once __DIR__ . "/../config/database.php";

$db  = new Database();
$pdo = $db->connect();

echo "Conectado a: " . $pdo->query("SELECT DATABASE()")->fetchColumn();