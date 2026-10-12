<?php
$host = 'localhost'; $db = 'bris_db'; $user = 'root'; $pass = '';
try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
} catch (PDOException $e) {
  exit('Database connection failed. Start MySQL in XAMPP and import database/bris.sql in phpMyAdmin.');
}
