<?php
$host = 'localhost';  // Database host
$dbname = 'task_manager'; // Your database name
$username = 'root'; // Database username
$password = ''; // Database password, set it if you have one

// DSN (Data Source Name) for PDO
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
