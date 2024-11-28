<?php
session_start();

// Verifica se o usuário está logado
$logged_in = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech & Innovation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="imagens/logo1.webp" type="image/x-icon">
    <style>
        .view-news-button {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            text-align: center;
        }

        .view-news-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="nome-do-blog" id="topo">Tech & Innovation</div>
        <nav class="menu">
            <a href="index.php">Blog</a>
            <a href="sobre.php">Sobre</a>
            <?php if ($logged_in): ?>
                <a href="logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php">Entrar</a>
                <a href="cadastro.php">Cadastrar</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- Conteúdo principal -->
    <main class="noticia-principal">
        <div class="imagem-da-noticia-principal">
            <img src="imagens/VW-GOLF_CES_COCKPIT.webp" alt="interior do carro da Volkswagen">
        </div>
        <div class="texto-da-noticia-principal">
            <h2>ChatGPT em carros da Volkswagen</h2>
            <p>A Volkswagen anunciou a integração de um assistente virtual alimentado por IA, o ChatGPT, em seus modelos com o assistente de voz IDA.
                Tecnologia acaba de estrear nos veículos europeus da montadora e promete inserção de assistente de voz</p>
        </div>
    </main>

    <!-- Botão para Visualizar Notícias -->
    <div style="text-align: center;">
        <a href="visualizar_noticias.php" class="view-news-button">Visualizar Notícias</a>
    </div>

    <!-- Rodapé -->
    <footer class="rodape">
        <div class="container-rodape">
            <div class="sobre-nos">
                <h4>Sobre Nós</h4>
                <p>Fornecemos as últimas notícias com precisão e confiabilidade. Acompanhe-nos nas redes sociais!</p>
            </div>
            <div class="links-uteis">
                <h4>Links Úteis</h4>
                <ul>
                    <li><a href="#politica-privacidade">Política de Privacidade</a></li>
                    <li><a href="#termos-uso">Termos de Uso</a></li>
                    <li><a href="#contato">Fale Conosco</a></li>
                </ul>
            </div>
            <div class="redes-sociais">
                <h4>Redes Sociais</h4>
                <a href="https://facebook.com" target="_blank">Facebook</a>
                <a href="https://twitter.com" target="_blank">Twitter</a>
                <a href="https://instagram.com" target="_blank">Instagram</a>
            </div>
        </div>
        <div class="direitos">
            <p>&copy; 2024 Tech & Innovation - Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
