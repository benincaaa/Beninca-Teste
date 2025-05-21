<?php
include_once './include/logado.php';
include_once './include/conexao.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "DELETE FROM usuarios WHERE UsuarioID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: lista-usuarios.php");
exit();
?>