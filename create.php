<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Contato</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
    <h1>Adicionar Contato</h1>
    <form action="" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Telefone:</label>
        <input type="text" name="telefone"><br>
        <button type="submit">Salvar</button>
        
    </form>
    <br>
    <div class="botao_voltar">
    <a href="index.php">
        <button >Voltar</button>
    </a>
    <br><br>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $sql = "INSERT INTO usuarios (nome, email, telefone) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $email, $telefone,]);

        echo "Contato adicionado com sucesso!";
    }
    ?>
    </div>
</body>
</html>
