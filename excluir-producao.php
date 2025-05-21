<?php
include_once './include/logado.php';
include_once './include/conexao.php';
 
$id = isset($_GET['id']) ? $_GET['id'] : null;
 
if ($id) {
    $sql = "DELETE FROM producao WHERE ProducaoID = $id";
   
    if ($conn->query($sql)) {
        header("Location: lista-producao.php");
        exit();
    } else {
        echo "Erro ao excluir a produção: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
 
 