<?php require_once 'db.php';

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