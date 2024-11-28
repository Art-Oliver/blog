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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Visualizar Notícias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
        }

        .noticia {
            border-bottom: 1px solid #ddd;
            padding: 20px 0;
            display: flex;
            align-items: center;
        }

        .noticia img {
            max-width: 200px;
            max-height: 150px;
            margin-right: 20px;
            border-radius: 8px;
            object-fit: cover;
        }

        .noticia .info {
            flex: 1;
        }

        .noticia h2 {
            margin: 0 0 10px;
            color: #333;
        }

        .noticia p {
            margin: 5px 0;
        }

        .noticia .data {
            font-size: 0.9em;
            color: #777;
        }

        .return-button {
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

        .return-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="return-button">Voltar para o Blog</a>

        <h1>Notícias</h1>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="noticia">
                    <img src="<?= htmlspecialchars($row['imagem']); ?>" alt="<?= htmlspecialchars($row['titulo']); ?>">
                    <div class="info">
                        <h2><?= htmlspecialchars($row['titulo']); ?></h2>
                        <p class="data"><?= htmlspecialchars(date('d/m/Y', strtotime($row['data']))); ?></p>
                        <p><?= htmlspecialchars($row['descricao']); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhuma notícia encontrada.</p>
        <?php endif; ?>

        <a href="index.php" class="return-button">Voltar para o Blog</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
