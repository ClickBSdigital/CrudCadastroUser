<?php require_once 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
