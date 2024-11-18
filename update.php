<?php require_once  'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$contato = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
</head>
<body>
    <h1>Editar Contato</h1>
    <form action="" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $contato['nome'] ?>" required><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?= $contato['email'] ?>" required><br>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= $contato['telefone'] ?>"><br>
        <button type="submit">Atualizar</button>
    </form>
    <br>
    <a href="index.php">
        <button >Voltar</button>
    </a>
    <br>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $sql = "UPDATE usuarios SET nome = ?, email = ?, telefone = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $email, $telefone, $id]);

        echo "Contato atualizado com sucesso!";
    }
    ?>
</body>
</html>
