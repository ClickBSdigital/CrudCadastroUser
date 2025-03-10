function confirmToggleStatus(userId) {
    var checkbox = document.getElementById("toggle-" + userId);
    var novoStatus = checkbox.checked ? 0 : 1; // 0 = ativo, 1 = inativo
    

    // Exibir modal de confirmação
    var confirmModal = document.getElementById("confirmModal");
    confirmModal.style.display = "block";

    // Configurar os botões do modal
    document.getElementById("confirmButton").onclick = function() {
        toggleStatus(userId, novoStatus);
        confirmModal.style.display = "none"; // Fechar modal
    };

    document.getElementById("cancelButton").onclick = function() {
        checkbox.checked = !checkbox.checked; // Reverter o estado do checkbox
        confirmModal.style.display = "none"; // Fechar modal
    };
}

// Função para ordenar usuários
usort($usuarios, function($a, $b) {
    if ($a['status'] === $b['status']) {
        return strcmp($a['nome'], $b['nome']);
    }
    return $a['status'] === 'inativo' ? 1 : -1;
});


function toggleStatus(userId, novoStatus) {
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
