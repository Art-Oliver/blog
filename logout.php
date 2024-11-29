<?php
session_start();

// Verificar se a sessão está ativa
if (isset($_SESSION['usuario_id']) || isset($_SESSION['admin'])) {
    // Destruir a sessão para fazer logout
    session_unset(); // Remove todas as variáveis de sessão
    session_destroy(); // Destrói a sessão

    // Redireciona para a página principal após o logout
    header("Location: index.php");
    exit;
} else {
    // Se não houver sessão ativa, redireciona para a página inicial
    header("Location: index.php");
    exit;
}
?>
