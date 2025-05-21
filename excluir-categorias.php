<?php
include_once './include/logado.php';
include_once './include/conexao.php';
 
$id = isset($_GET['id']) ? $_GET['id'] : null;
 
if ($id) {
    $sql = "DELETE FROM categorias WHERE CategoriaID = $id";
   
    if ($conn->query($sql)) {
        header("Location: lista-categorias.php");
        exit();
    } else {
        echo "Erro ao excluir a categoria: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
 
 