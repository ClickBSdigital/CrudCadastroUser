<?php include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM contatos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
