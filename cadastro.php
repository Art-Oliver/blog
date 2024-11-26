<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/logo1.webp" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro - Tech & Innovation</title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conexao.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

    // Verifica se o e-mail já existe
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p class='error-message'>Erro: E-mail já cadastrado!</p>";
    } else {
        // Insere o novo usuário
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha);
        if ($stmt->execute()) {
            echo "<p class='success-message'>Cadastro realizado com sucesso!</p>";
        } else {
            echo "<p class='error-message'>Erro no cadastro!</p>";
        }
    }
}
?>

    <section class="formulario">
        <h2>Cadastro de Usuário</h2>

        <form class="noticia-form" method="POST" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit" class="form-button">Cadastrar</button>
        </form>
    </section>
</body>
</html>
