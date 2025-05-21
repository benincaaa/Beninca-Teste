<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$sql = "SELECT UsuarioID, usuario, email FROM usuarios";
$result = $conn->query($sql);

if (!$result) {
    die('Erro na consulta: ' . $conn->error);
}
?>

<main>
    <div class="container" style="max-width:900px; margin:40px auto; background:#fff; border-radius:12px; box-shadow:0 2px 8px #0001; padding:32px;">
        <h2 style="margin-bottom:24px;">Lista de Usuários</h2>
        <a href="salvar-usuarios.php" class="btn" style="background:#28a745; color:#fff; padding:8px 24px; border-radius:5px; text-decoration:none; font-weight:bold; margin-bottom:18px; display:inline-block;">Incluir</a>
        <table style="width:100%; border-collapse:collapse; margin-top:10px;">
            <tr style="background:#333; color:#fff;">
                <th style="padding:8px;">ID</th>
                <th style="padding:8px;">Usuário</th>
                <th style="padding:8px;">Email</th>
                <th style="padding:8px;">Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr style="border-bottom:1px solid #eee;">
                <td style="padding:8px; text-align:center;"><?php echo $row['UsuarioID']; ?></td>
                <td style="padding:8px;"><?php echo htmlspecialchars($row['usuario']); ?></td>
                <td style="padding:8px;"><?php echo htmlspecialchars($row['email']); ?></td>
                <td style="padding:8px; text-align:center;">
                    <a href="salvar-usuarios.php?id=<?php echo $row['UsuarioID']; ?>" class="btn-editar" style="background:#ffc107; color:#222; padding:6px 16px; border-radius:4px; text-decoration:none; font-weight:bold; margin-right:6px;">Editar</a>
                    <a href="excluir-usuarios.php?id=<?php echo $row['UsuarioID']; ?>" class="btn-excluir" style="background:#dc3545; color:#fff; padding:6px 16px; border-radius:4px; text-decoration:none; font-weight:bold;" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</main>

<?php
include_once './include/footer.php';
?>