<?php
$host = 'localhost';
$dbname = 'phishing';
$username = 'phishing'; // Altere conforme sua configuração
$password = 'phishing';     // Altere conforme sua configuração

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
