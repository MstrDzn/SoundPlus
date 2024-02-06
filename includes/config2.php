<?php
// Connexion à la base de données
$host = 'localhost';
$db   = 'soundplus4';
$user = 'phpmyadmin';
$pass = 'root';
$charset = 'utf8mb4';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
?>