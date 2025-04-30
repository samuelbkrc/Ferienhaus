<?php
$host = 'localhost';
$db   = 'ferienhaus_db';         // Name deiner Datenbank in phpMyAdmin
$user = 'root';               // Standard bei XAMPP
$pass = '';                   // Standard: kein Passwort
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Fehler beim Verbindungsaufbau zur Datenbank");
}
?>
