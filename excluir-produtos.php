<?php
include_once './include/logado.php';
include_once './include/conexao.php';
 
$id = isset($_GET['id']) ? $_GET['id'] : null;
 
if ($id) {
    $sql = "DELETE FROM produtos WHERE ProdutoID = $id";
   
    if ($conn->query($sql)) {
        header("Location: lista-produtos.php");
        exit();
    } else {
        echo "Erro ao excluir o produto: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
 
 