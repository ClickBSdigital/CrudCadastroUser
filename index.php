<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Listar</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Lista de Contatos</h1>
    <a href="create.php">Adicionar Novo Contato</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $contatos = $stmt->fetchAll();
        foreach ($contatos as $contato) {
            echo "<tr>
                    <td>{$contato['id_usuario']}</td>
                    <td>{$contato['nome']}</td>
                    <td>{$contato['email']}</td>
                    <td>{$contato['telefone']}</td>
                    <td>{$contato['status']}</td>
                    
                    <td>

                        <a href='update.php?id={$contato['id_usuario']}'>Editar</a> | 
                        <a href='delete.php?id={$contato['id_usuario']}'>Excluir</a> |
                        <a href='inativar.php?id={$contato['id_usuario']}'>Inativar</a>
                        <a href='update.php?id={$contato['id_usuario']}'>Editar</a> |
                        <a href='modal_delete.php'  >Excluir</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
<!-- Modal de confirmação -->
    <div id="modalExcluir" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h3>Confirmação de Exclusão</h3>
            <div class="detalhes-contato">
                <p><strong>ID:</strong> <span id="modalId"></span></p>
                <p><strong>Nome:</strong> <span id="modalNome"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <p><strong>Telefone:</strong> <span id="modalTelefone"></span></p>
            </div>
            <p>Tem certeza que deseja excluir este contato?</p>
            <button id="confirmarBtn">Sim</button>
            <button onclick="fecharModal()">Não</button>
        </div>
    </div>
   


</body>
</html>
