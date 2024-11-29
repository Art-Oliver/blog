<?php
$host = 'localhost';      // Endereço do servidor MySQL
$username = 'root';       // Usuário do MySQL (geralmente 'root')
$password = '';           // Senha do MySQL (deixe vazio se não tiver)
$dbname = 'sistema_login'; // Nome do banco de dados

// Criar conexão com MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
