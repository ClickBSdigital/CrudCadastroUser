<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO usuarios (nome, email, telefone, status) VALUES (:nome, :email, :telefone, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    
    if ($stmt->execute()) {
        echo "Contato cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar contato.";
    }
}
?>
