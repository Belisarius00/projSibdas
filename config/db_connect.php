<?php
// config/db_connect.php

$host = 'localhost';
$db_name = 'inventario_hospitalar'; // Make sure this matches your MySQL database name
$username = 'root'; // Default XAMPP/WAMP username
$password = ''; // Default XAMPP/WAMP password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    
    // Set the PDO error mode to exception so we can catch errors easily
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Uncomment the line below to test the connection during development
    // echo "Connected successfully!";
    
} catch(PDOException $e) {
    // If the connection fails, stop the script and show the error
    die("Connection failed: " . $e->getMessage());
}
?>