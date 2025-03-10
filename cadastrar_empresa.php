<?php
require 'config.php';

$mensagem = ''; // Variável para armazenar mensagens de feedback

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);

    if (!empty($nome)) {
        $sql = "INSERT INTO empresas (nome) VALUES (:nome)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        if ($stmt->execute()) {
            $mensagem = "<div class='alert alert-success'>Empresa cadastrada com sucesso!</div>";
        } else {
            $mensagem = "<div class='alert alert-danger'>Erro ao cadastrar empresa.</div>";
        }
    } else {
        $mensagem = "<div class='alert alert-warning'>O nome da empresa não pode estar vazio.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empresas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro de Empresas</h1>
        
        <?php echo $mensagem; // Exibe a mensagem de feedback ?>

        <form method="POST" class="mb-3">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Empresa:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <!-- Bootstrap JS (opcional, se precisar de funcionalidades JS do Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>