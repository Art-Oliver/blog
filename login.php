<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/logo1.webp" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Login - Tech & Innovation</title>
</head>
<body>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o e-mail existe
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            echo "<p class='success-message'>Bem-vindo, " . $_SESSION['nome'] . "!</p>";
        } else {
            echo "<p class='error-message'>Senha incorreta!</p>";
        }
    } else {
        echo "<p class='error-message'>Usuário não encontrado!</p>";
    }
}
?>

    <section class="formulario">
        <h2>Login de Usuário</h2>

        <form class="noticia-form" method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit" class="form-button">Entrar</button>
        </form>
    </section>
</body>
</html>
