<?php require_once  'db.php';

// <<<<<<< HEAD
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
    <title>DELETAR Contato</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
    <h1>DELETAR Contato</h1>
    <form action="" method="post">
    <label>Nome do Contato:</label>
        
        <li><strong>Email:</strong> <?= $contato['email'] ?></li>
        <li><strong>Nome:</strong> <?= $contato['nome'] ?></li>
        <BR>
        <button type="submit">DELETAR</button>
    </form>
    <br>
    <a href="index.php">
        <button >Voltar</button>
    </a>
    <br>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            
            $sql = 'DELETE FROM usuarios WHERE email = ?';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);

            echo "Contato DELETADO com sucesso!";
        }
        else{
          echo "Não deletado!";
        }
    ?>
</body>
</html>
=======
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])){
    $id = $_GET['id'];
    // $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

header("Location: modal_delete.php");

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $pdo->prepare('"DELETE FROM usuarios WHERE id_usuario = :id')
    
}
}
>>>>>>> 1d80912e31ddf178d743469e64202517f41809c5
