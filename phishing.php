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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atenção!</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .alert-box {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .alert-box h2 {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="alert-box text-center">
            <h2>🚨 Simulação de Phishing 🚨</h2>
            <p class="lead mt-3">Este é um teste de conscientização sobre segurança digital.</p>
            <p>Se você chegou até aqui, significa que clicou em um link suspeito.</p>
            <hr>
            <p class="text-muted">Lembre-se de sempre verificar a autenticidade dos links antes de clicar.</p>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, se precisar de funcionalidades JS do Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>