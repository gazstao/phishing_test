<?php
require 'config.php';

// Buscar empresas para selecionar no formulário
$empresas = $pdo->query("SELECT * FROM empresas")->fetchAll(PDO::FETCH_ASSOC);

$mensagem = ''; // Variável para armazenar mensagens de feedback

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
            $mensagem = "<div class='alert alert-success'>Usuário cadastrado com sucesso! Token: $token</div>";
        } else {
            $mensagem = "<div class='alert alert-danger'>Erro ao cadastrar usuário.</div>";
        }
    } else {
        $mensagem = "<div class='alert alert-warning'>Preencha todos os campos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro de Usuários</h1>

        <?php echo $mensagem; // Exibe a mensagem de feedback ?>

        <form method="POST" class="mb-3">
            <div class="mb-3">
                <label for="empresa_id" class="form-label">Empresa:</label>
                <select class="form-select" id="empresa_id" name="empresa_id" required>
                    <?php foreach ($empresas as $empresa) : ?>
                        <option value="<?= $empresa['id'] ?>"><?= $empresa['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Usuário:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <!-- Bootstrap JS (opcional, se precisar de funcionalidades JS do Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>