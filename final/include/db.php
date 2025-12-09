<?php
$host = 'localhost';
$db   = 'bookifydb';
$user = 'root';
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
