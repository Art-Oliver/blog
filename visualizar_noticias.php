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
    
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="nome-do-blog" id="topo">Tech & Innovation</div>
        <nav class="menu">
            <a href="index.php">Blog</a>
            <a href="sobre.html">Sobre</a>
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



    <!-- campo de noticias -->

        <?php
    // Conexão com o banco de dados
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'sistema_blog';

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    }

    // Consultar notícias
    $sql = "SELECT id, titulo, data, descricao, imagem FROM noticias ORDER BY data DESC";
    $result = $conn->query($sql);
    ?>


    

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <section class="secao-noticias">
                    <div class="area-noticias">
                        <article class="noticias">

                                <img  src="<?= htmlspecialchars($row['imagem']); ?>" alt="<?= htmlspecialchars($row['titulo']); ?>">

                            <div class="conteudo-da-noticia">   
                                <h2 class="titulo-da-noticia"><?= htmlspecialchars($row['titulo']); ?></h2>

                                <p class="data-da-noticia"><?= htmlspecialchars(date('d/m/Y', strtotime($row['data']))); ?></p>
                                
                                <p class="texto-da-noticia"><?= htmlspecialchars($row['descricao']); ?></p>
                            </div>
                            
                        </article>
                    </div>
                </section>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="notificacoes-de-erro">Nenhuma notícia encontrada.</p>
        <?php endif; ?>


    <?php
    $conn->close();
    ?>

<!--formulario add noticias -->
    <?php
    // Conexão com o banco de dados
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'sistema_blog';

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    }

    // Inserção de notícia no banco de dados
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $data = $_POST['data'];
        $descricao = $_POST['descricao'];
        $imagem = $_POST['imagem'];

        $sql = "INSERT INTO noticias (titulo, data, descricao, imagem) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $titulo, $data, $descricao, $imagem);

        if ($stmt->execute()) {
            // Redireciona para a página de visualização de notícias
            header("Location: visualizar_noticias.php");
            exit; // Garante que o restante do código não será executado
        } else {
            echo "<p class='error'>Erro ao adicionar notícia: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    $conn->close();
    ?>

    <?php if ($logged_in): ?>
        <div class="formulario">
            <h1>Adicionar Nova Notícia</h1>
            <form class="noticia-form" method="POST" action="criar_noticias.php">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Digite o título da notícia" required>

                <label for="data">Data:</label>
                <input type="date" id="data" name="data" required>

                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="5" placeholder="Digite a descrição da notícia" required></textarea>

                <label for="imagem">URL da Imagem:</label>
                <input type="url" id="imagem" name="imagem" placeholder="Cole o link da imagem" required>

                <button class="form-button" type="submit">Adicionar Notícia</button>
            </form>
        </div>
        <?php else: ?>
    <p class="error"></p>
    <?php endif; ?>



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
