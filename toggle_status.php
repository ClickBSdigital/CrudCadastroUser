<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status']; // 0 = ativo, 1 = inativo

    $sql = "UPDATE usuarios SET statos = :status WHERE id_usuario = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "Status atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar status.";
    }
}
?>
