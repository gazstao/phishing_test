<?php
require 'config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Buscar o usuário pelo token
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $usuario_id = $usuario['id'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        // Registrar acesso no banco de dados
        $sql = "INSERT INTO acessos (usuario_id, ip, user_agent) VALUES (:usuario_id, :ip, :user_agent)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':ip', $ip);
        $stmt->bindParam(':user_agent', $user_agent);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atenção!</title>
</head>
<body>
    <h2>🚨 Simulação de Phishing 🚨</h2>
    <p>Este é um teste de conscientização sobre segurança digital.</p>
    <p>Se você chegou até aqui, significa que clicou em um link suspeito.</p>
</body>
</html>
