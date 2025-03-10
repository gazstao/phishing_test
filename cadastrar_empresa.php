<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);

    if (!empty($nome)) {
        $sql = "INSERT INTO empresas (nome) VALUES (:nome)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        if ($stmt->execute()) {
            echo "Empresa cadastrada com sucesso!";
        } else {
            echo "Erro ao cadastrar empresa.";
        }
    } else {
        echo "O nome da empresa não pode estar vazio.";
    }
}
?>

<form method="POST">
    <label>Nome da Empresa:</label>
    <input type="text" name="nome" required>
    <button type="submit">Cadastrar</button>
</form>
