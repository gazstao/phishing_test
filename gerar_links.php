<?php
require 'config.php';

// Buscar todos os usuários cadastrados
$usuarios = $pdo->query("SELECT usuarios.id, usuarios.nome, usuarios.email, usuarios.token, empresas.nome AS empresa 
                         FROM usuarios 
                         JOIN empresas ON usuarios.empresa_id = empresas.id")
                ->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Lista de Usuários e Links de Phishing</h2>
<table border="1">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Empresa</th>
        <th>Link de Phishing</th>
    </tr>
    <?php foreach ($usuarios as $usuario) : ?>
        <tr>
            <td><?= htmlspecialchars($usuario['nome']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
            <td><?= htmlspecialchars($usuario['empresa']) ?></td>
            <td>
                <a href="phishing.php?token=<?= $usuario['token'] ?>" target="_blank">
                    phishing.php?token=<?= $usuario['token'] ?>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
