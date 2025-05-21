<?php
include_once './include/logado.php';
include_once './include/conexao.php';
 
$id = isset($_GET['id']) ? $_GET['id'] : null;
 
if ($id) {
    $sql = "DELETE FROM setor WHERE SetorID = $id";
   
    if ($conn->query($sql)) {
        header("Location: lista-setores.php");
        exit();
    } else {
        echo "Erro ao excluir o setor: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
 
 