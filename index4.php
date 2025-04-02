<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Listar</title>
    <link rel="stylesheet" href="style.css">
    <script src="script3.js"></script>
</head>
<body>
<h1>Lista de Contatos</h1>
<button onclick="openModal()">Adicionar Novo Contato</button>

<!-- Modal de Cadastro -->
<div id="modalCadastro" style="display:none; position:fixed; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000;">
    <div style="background-color:white; margin:10% auto; padding:20px; width:400px; text-align:center; border-radius:8px;">
        <h2>Novo Contato</h2>
        <form id="formCadastro">
            <input type="text" id="nome" placeholder="Nome" required><br><br>
            <input type="email" id="email" placeholder="Email" required><br><br>
            <input type="text" id="telefone" placeholder="Telefone" required><br><br>
            <button type="button" onclick="cadastrarContato()">Salvar</button>
            <button type="button" onclick="closeModal()">Cancelar</button>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById("modalCadastro").style.display = "block";
}

function closeModal() {
    document.getElementById("modalCadastro").style.display = "none";
}

function cadastrarContato() {
    var nome = document.getElementById("nome").value;
    var email = document.getElementById("email").value;
    var telefone = document.getElementById("telefone").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "create.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("nome=" + nome + "&email=" + email + "&telefone=" + telefone);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText); // Mensagem de sucesso ou erro
            closeModal();
            location.reload(); // Recarrega a página para atualizar a lista
        }
    };
}
</script>
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
            // Corrigido para usar 'status' em vez de 'statos'
            $checked = $contato['status'] == 0 ? 'checked' : ''; // Se inativo = 0, marca como ativo
            echo "<tr>
                    <td>{$contato['id_usuario']}</td>
                    <td>{$contato['nome']}</td>
                    <td>{$contato['email']}</td>
                    <td>{$contato['telefone']}</td>
                    <td>
                        <label class='switch'>
                            <input type='checkbox' id='toggle-{$contato['id_usuario']}' onclick='confirmToggleStatus({$contato['id_usuario']})' {$checked}>
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

    <!-- Modal de Confirmação -->
    <div id="confirmModal" style="display:none; position:fixed; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000;">
        <div style="background-color:white; margin:15% auto; padding:20px; width:300px; text-align:center;">
            <h2>Confirmação</h2>
            <p>Você tem certeza que deseja alterar o status?</p>
            <button id="confirmButton">Sim</button>
            <button id="cancelButton">Não</button>
        </div>
    </div>

    <style>
        /* Estilização do Toggle Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px; /* Aumentado para um tamanho maior */
            height: 24px; /* Aumentado para um tamanho maior */
        }

        .switch input {
            opacity: 0; /* Esconde o checkbox */
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
            background-color: #ff0000; /* Cor de fundo quando inativo */
            transition: background-color 0.4s, border-radius 0.4s; /* Transição suave */
            border-radius: 24px; /* Bordas arredondadas */
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px; /* Altura do círculo */
            width: 20px; /* Largura do círculo */
            left: 2px; /* Margem
                        left: 2px; /* Margem esquerda */
                        bottom: 2px; /* Margem inferior */
            background-color: white; /* Cor do círculo */
            transition: transform 0.4s; /* Transição suave para o movimento */
            border-radius: 50%; /* Círculo perfeito */
        }

        input:checked + .slider {
            background-color: #4CAF50; /* Cor de fundo quando ativo */
        }

        input:checked + .slider:before {
            transform: translateX(26px); /* Move o círculo para a direita */
        }
    </style>
</body>
</html>