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

    <section class="secao-noticias">
        <div class="area-noticias">
            <!-- Artigo 1 -->
            <article class="noticias">
                <img src="imagens/tv-lg.webp" alt="tv transparente">
                <div class="conteudo-da-noticia">
                    <p class="data-da-noticia">09/01/2024</p>
                    <h3 class="titulo-da-noticia">Televisão transparente da LG</h3>
                    <p class="texto-da-noticia">A coreana LG revelou uma televisão OLED transparente e sem fio, a LG Signature OLED T.</p>
                </div>
            </article>

            <!-- Artigo 2 -->
            <article class="noticias">
                <img src="imagens/monitor-asus.webp" alt="monitor portatil e dobravel">
                <div class="conteudo-da-noticia">
                    <p class="data-da-noticia">09/01/2024</p>
                    <h3 class="titulo-da-noticia">Asus surpreende com um monitor OLED portátil e dobrável</h3>
                    <p class="texto-da-noticia">A Asus apresentou um monitor OLED dobrável e portátil, ideal para quem precisa de uma segunda tela e de movimento.</p>
                </div>
            </article>

            <!-- Artigo 3 -->
            <article class="noticias">
                <img src="imagens/caminhao.webp" alt="caminhao">
                <div class="conteudo-da-noticia">
                    <p class="data-da-noticia">09/01/2024</p>
                    <h3 class="titulo-da-noticia">Caminhão autônomo da Kodiak Robotics</h3>
                    <p class="texto-da-noticia">A Kodiak Robotics introduziu um caminhão semi-autônomo com, segundo a empresa, segurança avançadas, incluindo sistemas de redundância para garantir operação segura em rodovias.</p>
                </div>
            </article>
        </div>
    </section>

    <?php if ($logged_in): ?>
        <section class="formulario">
            <h2>Adicionar Nova Notícia</h2>
            <form id="add-noticia" class="noticia-form">
                <label for="titulo-da-noticia">Título:</label>
                <input type="text" id="titulo-da-noticia" name="titulo-da-noticia" placeholder="Digite o título da notícia" required>
        
                <label for="data-da-noticia">Data:</label>
                <input type="date" id="data-da-noticia" name="data-da-noticia" required>
        
                <label for="texto-da-noticia">Descrição:</label>
                <textarea id="texto-da-noticia" name="texto-da-noticia" rows="3" placeholder="Digite uma breve descrição" required></textarea>
        
                <label for="news-image">URL da Imagem:</label>
                <input type="url" id="news-image" name="news-image" placeholder="Cole o link da imagem" required>
        
                <button type="submit" class="form-button">Adicionar Notícia</button>
            </form>
        </section>
    <?php endif; ?>

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

    <script>
        <?php if ($logged_in): ?>
        document.getElementById("add-noticia").addEventListener("submit", function (e) {
            e.preventDefault();
            const title = document.getElementById("titulo-da-noticia").value;
            const date = document.getElementById("data-da-noticia").value;
            const description = document.getElementById("texto-da-noticia").value;
            const image = document.getElementById("news-image").value;
            const newArticle = document.createElement("article");
            newArticle.classList.add("noticias");
            newArticle.innerHTML = `
                <img src="${image}" alt="${title}">
                <div class="conteudo-da-noticia">
                    <p class="data-da-noticia">${date}</p>
                    <h3 class="titulo-da-noticia">${title}</h3>
                    <p class="texto-da-noticia">${description}</p>
                </div>
            `;
            document.querySelector(".area-noticias").appendChild(newArticle);
            document.getElementById("add-noticia").reset();
        });
        <?php endif; ?>
    </script>
</body>
</html>
