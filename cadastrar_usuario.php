<?php
require 'config.php';

// Buscar empresas para selecionar no formulário
$empresas = $pdo->query("SELECT * FROM empresas")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empresa_id = $_POST['empresa_id'];
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $token = bin2hex(random_bytes(16)); // Gera um token único de 32 caracteres

    if (!empty($empresa_id) && !empty($nome) && !empty($email)) {
        $sql = "INSERT INTO usuarios (empresa_id, nome, email, token) VALUES (:empresa_id, :nome, :email, :token)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso! Token: $token";
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    } else {
        echo "Preencha todos os campos.";
    }
}
?>

<form method="POST">
    <label>Empresa:</label>
    <select name="empresa_id" required>
        <?php foreach ($empresas as $empresa) : ?>
            <option value="<?= $empresa['id'] ?>"><?= $empresa['nome'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Nome do Usuário:</label>
    <input type="text" name="nome" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <button type="submit">Cadastrar</button>
</form>
