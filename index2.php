<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Listar</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function toggleStatus(userId) {
            var checkbox = document.getElementById("toggle-" + userId);
            var novoStatus = checkbox.checked ? 0 : 1; // 0 = ativo, 1 = inativo

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "toggle_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("id=" + userId + "&status=" + novoStatus);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
        }
    </script>
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
            $checked = $contato['status'] == 0 ? 'checked' : ''; // Se inativo = 0, marca como ativo
            echo "<tr>
                    <td>{$contato['id_usuario']}</td>
                    <td>{$contato['nome']}</td>
                    <td>{$contato['email']}</td>
                    <td>{$contato['telefone']}</td>
                    <td>
                        <label class='switch'>
                            <input type='checkbox' id='toggle-{$contato['id_usuario']}' onclick='toggleStatus({$contato['id_usuario']})' {$checked}>
                            <span class='slider'></span>
                        </label>
                    </td>
                    <td>
                        <a href='update.php?id={$contato['id_usuario']}'>Editar</a> | 
                        <a href='delete.php?id={$contato['id_usuario']}'>Excluir</a>
                    </td>
                </tr>";
        }
        ?>
    </table>

    <style>
        /* Estilização do Toggle Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }
        .switch input { 
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:checked + .slider:before {
            transform: translateX(20px);
        }
    </style>
</body>
</html>



