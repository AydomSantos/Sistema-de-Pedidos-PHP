<?php
// Database connection settings
$host = "localhost";
$dbname = "sistema_pedidos_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Fix: Change setAtribute to setAttribute
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}



