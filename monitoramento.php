<?php
require 'config.php';

// Buscar todos os usuários e seus acessos
$usuarios = $pdo->query("SELECT usuarios.id, usuarios.nome, usuarios.email, usuarios.token, 
                                (SELECT COUNT(*) FROM acessos WHERE acessos.usuario_id = usuarios.id) AS acessos
                         FROM usuarios")
                ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Monitoramento</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .table thead th {
            background-color: #343a40;
            color: #fff;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Painel de Monitoramento</h2>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Link de Phishing</th>
                    <th>Acessou?</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td>
                            <a href="phishing.php?token=<?= $usuario['token'] ?>" target="_blank" class="text-decoration-none">
                                phishing.php?token=<?= $usuario['token'] ?>
                            </a>
                        </td>
                        <td class="text-center">
                            <?php if ($usuario['acessos'] > 0) : ?>
                                <span class="text-success"><i class="bi bi-check-circle-fill"></i> Sim</span>
                            <?php else : ?>
                                <span class="text-danger"><i class="bi bi-x-circle-fill"></i> Não</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (opcional, se precisar de funcionalidades JS do Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>