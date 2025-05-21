<?php
include_once './include/logado.php';
include_once './include/conexao.php';
 
$id = isset($_GET['id']) ? $_GET['id'] : null;
 
if ($id) {
    $sql = "DELETE FROM funcionarios WHERE FuncionarioID = $id";
   
    if ($conn->query($sql)) {
        header("Location: lista-funcionarios.php");
        exit();
    } else {
        echo "Erro ao demitir o funcionário: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
 
 