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
    <title>Alterar Status do Contato </title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
    <h1>Alterar Status do Contato</h1>
    <form action="" method="post">
        
        <label>Email:</label>
        <input type="email" name="email" value="<?= $contato['email'] ?>" required><br>
        <label>Status:</label>

        <input type="text" name="inativo" value="<?= $contato['inativo'] ?>"><br>

        <label>Status:</label>
        <select name="inativo">
            <option value="0" <?= $contato['inativo'] == 0 ? 'selected' : '' ?>>Ativo</option>
            <option value="1" <?= $contato['inativo'] == 1 ? 'selected' : '' ?>>Inativo</option>
        </select><br>
        
        <button type="submit">Inativar</button>
    </form>
    <br>
    <a class=() href="index.php">
        <button >Voltar</button>
    </a>
    <br>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $inativo = $_POST['inativo'];
           

            $sql = "UPDATE usuarios SET inativo = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$inativo, $email]);

            echo "Contato INATIVADO com sucesso!";
        }
    ?>
</body>
</html>
