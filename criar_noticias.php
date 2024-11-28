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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Criar Notícias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input, textarea, button {
            margin-top: 5px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            margin-top: 20px;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Adicionar Nova Notícia</h1>
        <form method="POST" action="criar_noticias.php">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Digite o título da notícia" required>

            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="5" placeholder="Digite a descrição da notícia" required></textarea>

            <label for="imagem">URL da Imagem:</label>
            <input type="url" id="imagem" name="imagem" placeholder="Cole o link da imagem" required>

            <button type="submit">Adicionar Notícia</button>
        </form>
    </div>
</body>
</html>
