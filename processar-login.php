<?php
include_once './include/conexao.php';
session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE Usuario = ? OR Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $usuario);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();

if ($user && password_verify($senha, $user['Senha'])) {
    $_SESSION['usuario'] = $user['Usuario'];
    $_SESSION['usuario_id'] = $user['UsuarioID'];
    header("Location: index.php");
    exit();
} else {
    header("Location: login.php?erro=1");
    exit();
}
?>