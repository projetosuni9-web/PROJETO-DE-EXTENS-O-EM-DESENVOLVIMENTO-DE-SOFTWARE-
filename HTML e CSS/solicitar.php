<?php
// ======================
// PÁGINA DE CONFIRMAÇÃO DE COMPRA
// Funciona sem banco de dados e sem sessão.
// Recebe o título e a origem do livro via parâmetros GET na URL.
// Exemplo: solicitar.php?livro=Dom+Casmurro&origem=domcasmurro.html
// ======================

// Pega o nome do livro enviado via GET (sanitizado para exibição segura)
$nomeLivro = isset($_GET["livro"]) ? htmlspecialchars(trim($_GET["livro"])) : "este livro";

// Pega a página de origem para o botão voltar (fallback para index)
$origem = isset($_GET["origem"]) ? htmlspecialchars(trim($_GET["origem"])) : "index.html";

// Monta a mensagem de confirmação com o nome do livro
$msg = "Pedido de \"" . $nomeLivro . "\" enviado com sucesso! Procure a biblioteca para mais informações.";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<!-- ======================
     CONFIGURAÇÃO DA PÁGINA
====================== -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Solicitar Compra - Corujoteca</title>

<!-- FAVICON -->
<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

<!-- ESTILO DA PÁGINA -->
<link rel="stylesheet" href="solicitar.css">

</head>
<body>

<!-- ======================
     POPUP DE CONFIRMAÇÃO
     Exibe a mensagem de sucesso e botão OK para voltar
====================== -->
<div class="aviso-overlay" id="aviso">
    <div class="aviso-box">
        <h2 id="avisoMsg">Mensagem</h2>
        <button class="btn-aviso" onclick="fecharAviso()">OK</button>
    </div>
</div>

<!-- ======================
     SCRIPTS
====================== -->
<script>

// Exibe o popup com a mensagem recebida
function mostrarAviso(msg) {
    const aviso = document.getElementById("aviso");
    const texto = document.getElementById("avisoMsg");

    texto.textContent = msg;
    aviso.classList.add("ativo");
}

// Fecha o popup e volta para a página do livro (ou index)
function fecharAviso() {
    document.getElementById("aviso").classList.remove("ativo");

    setTimeout(() => {
        window.location.href = "<?php echo $origem; ?>";
    }, 200);
}

// Mostra o popup assim que a página carrega
window.onload = function() {
    mostrarAviso("<?php echo addslashes($msg); ?>");
};

</script>

</body>
</html>
