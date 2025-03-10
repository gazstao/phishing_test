<?php
require 'config.php';

// Buscar todos os usuários e seus acessos
$usuarios = $pdo->query("SELECT usuarios.id, usuarios.nome, usuarios.email, usuarios.token, 
                                (SELECT COUNT(*) FROM acessos WHERE acessos.usuario_id = usuarios.id) AS acessos
                         FROM usuarios")
                ->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Painel de Monitoramento</h2>
<table border="1">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Link de Phishing</th>
        <th>Acessou?</th>
    </tr>
    <?php foreach ($usuarios as $usuario) : ?>
        <tr>
            <td><?= htmlspecialchars($usuario['nome']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
            <td>
                <a href="phishing.php?token=<?= $usuario['token'] ?>" target="_blank">
                    phishing.php?token=<?= $usuario['token'] ?>
                </a>
            </td>
            <td><?= $usuario['acessos'] > 0 ? "✅ Sim" : "❌ Não" ?></td>
        </tr>
    <?php endforeach; ?>
</table>
