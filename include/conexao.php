<?php
// dados do servidor de banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "meubanco";

//objeto que controla a conexao com o banco
$conn = new mysqli($host, $usuario, $senha, $banco);

//verifica a conexão
if ($conn->connect_error) {
    dia ("Falha na conexão: " . $conn->conect_error);
}

?>