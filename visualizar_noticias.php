<?php
session_start();
$logged_in = isset($_SESSION['usuario_id']);

// Configuração da conexão com o banco de dados
$host = "localhost";
$username = "root";
$password = ' ';
$dbname = "sistema_login";

$conn = new mysqli($host, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta as notícias do banco de dados
$sql = "SELECT titulo, data, descricao, imagem FROM noticias ORDER BY data DESC";
$result = $conn->query($sql);

// Armazena as notícias em um array
$noticias = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $noticias[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Notícias</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="imagens/logo1.webp" type="image/x-icon">
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="nome-do-blog">Tech & Innovation</div>
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

    <!-- Título da Página -->
    <section class="titulo-pagina">
        <h1>Últimas Notícias</h1>
    </section>

    <!-- Lista de Notícias -->
    <section class="secao-noticias">
        <div class="area-noticias">
            <?php if (count($noticias) > 0): ?>
                <?php foreach ($noticias as $noticia): ?>
                    <article class="noticias">
                        <img src="<?= htmlspecialchars($noticia['imagem']); ?>" alt="<?= htmlspecialchars($noticia['titulo']); ?>">
                        <div class="conteudo-da-noticia">
                            <p class="data-da-noticia"><?= date("d/m/Y", strtotime($noticia['data'])); ?></p>
                            <h3 class="titulo-da-noticia"><?= htmlspecialchars($noticia['titulo']); ?></h3>
                            <p class="texto-da-noticia"><?= htmlspecialchars($noticia['descricao']); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Não há notícias disponíveis no momento.</p>
            <?php endif; ?>
        </div>
    </section>

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
