<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';


$id = isset($_GET['id']) ? intval($_GET['id']) : null;


$usuario = [
    'usuario' => '',
    'email' => ''
];
if ($id) {
    $sql = "SELECT * FROM usuarios WHERE UsuarioID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $usuario = $res->fetch_assoc();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_nome = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($id) {
        if (!empty($senha)) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET usuario=?, email=?, senha=? WHERE UsuarioID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $usuario_nome, $email, $senha_hash, $id);
        } else {
            $sql = "UPDATE usuarios SET usuario=?, email=? WHERE UsuarioID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $usuario_nome, $email, $id);
        }
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (usuario, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $usuario_nome, $email, $senha_hash);
    }

    if ($stmt->execute()) {
        header("Location: lista-usuarios.php?cadastro=1");
        exit();
    } else {
        echo "<p style='color:red;'>Erro ao salvar usuário: " . $stmt->error . "</p>";
    }
}
?>

<main>
    <div class="container" style="max-width:500px; margin:40px auto; background:#fff; border-radius:12px; box-shadow:0 2px 8px #0001; padding:32px;">
        <h2><?php echo $id ? 'Editar Usuário' : 'Incluir Usuário'; ?></h2>
        <form method="POST" action="">
            <label>Usuário:</label>
            <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario['usuario']); ?>" required style="width:100%;padding:8px;margin-bottom:12px;">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required style="width:100%;padding:8px;margin-bottom:12px;">
            <label>Senha:</label>
            <input type="password" name="senha" <?php echo $id ? '' : 'required'; ?> style="width:100%;padding:8px;margin-bottom:18px;">
            <?php if ($id): ?>
                <small>Deixe em branco para não alterar a senha.</small>
            <?php endif; ?>
            <br><br>
            <button type="submit" class="btn" style="background:#28a745; color:#fff; padding:8px 24px; border-radius:5px; font-weight:bold;"><?php echo $id ? 'Salvar Alterações' : 'Cadastrar'; ?></button>
            <a href="lista-usuarios.php" class="btn" style="background:#6c757d; color:#fff; padding:8px 24px; border-radius:5px; font-weight:bold; margin-left:10px;">Voltar</a>
        </form>
    </div>
</main>

<?php
include_once './include/footer.php';
?>