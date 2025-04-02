

<?php require_once  'db.php';

  $id = $_GET['id'];
  $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
  $contato = $stmt->fetch();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="update.css">
</head>
<body>

<div class="container">
  <h2>Small Modal</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <h1>DELETAR Contato</h1>
          <form action="" method="post">
              <label>Nome:</label>
              <input type="text" name="nome" value="<?= $contato['nome'] ?>" required><br>
              <label>Email:</label>
              <input type="email" name="email" value="<?= $contato['email'] ?>" required><br>
              <label>Telefone:</label>
              <input type="text" name="telefone" value="<?= $contato['telefone'] ?>"><br>
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
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
=======
<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Listar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilo para o modal */
        .modal {
            display: none; /* Oculto por padrão */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            text-align: center;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
        }
    </style>
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
                    <td>
                        <a href='update.php?id={$contato['id_usuario']}>Editar</a> | 
                        <a href='#' onclick='confirmarExclusao({$contato['id_usuario']})'>Excluir</a>
                    </td>
                </tr>";
        }
        ?>
    </table>

    <!-- Modal de confirmação -->
    <div id="modalExcluir" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <p>Tem certeza que deseja excluir este contato?</p>
            <button id="confirmarBtn">Sim</button>
            <button onclick="fecharModal()">Não</button>
        </div>
    </div>

    <script>
        // Variáveis globais
        let modal = document.getElementById('modalExcluir');
        let confirmarBtn = document.getElementById('confirmarBtn');
        let idParaExcluir = null;

        // Função para abrir o modal e salvar o ID
        function confirmarExclusao(id) {
            idParaExcluir = id;
            modal.style.display = 'block';
        }

        // Função para fechar o modal
        function fecharModal() {
            modal.style.display = 'none';
            idParaExcluir = null;
        }

        // Função para confirmar a exclusão
        confirmarBtn.addEventListener('click', function() {
            if (idParaExcluir) {
                window.location.href = `delete.php?id=${idParaExcluir}`;
            }
        });

        // Fechar modal ao clicar fora do conteúdo
        window.onclick = function(event) {
            if (event.target === modal) {
                fecharModal();
            }
        };
    </script>
</body>
</html>




<!-- <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal confirma Deleta</title>
</head>
<body>
    
    <dialog id="modal">
        <h2>Deletar Contato</h2>
        <p>Você confirma a a EXCLUSÃO do contato? </p>
        <div>
        <button id="button_voltar">Voltar</button>
        <button id="button_excluir">Excluir</button>
        </div>
    </dialog>

    <script>
        const button = document.querySelector("btn")
        const modal = document.querySelector("#modal")
        const button = document.querySelector("#button_voltar")
        const button = document.querySelector("#button_excluir")

        btn.onclick = function (){
            modal.showModal()
        }
</body>
</html> -->

