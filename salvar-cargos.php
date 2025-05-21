<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
 
$id = isset($_GET['id']) ? $_GET['id'] : null;
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $teto_salarial = $_POST['teto_salarial'];
 
    if ($id) {
        $sql = "UPDATE cargos SET Nome = '$nome', TetoSalarial = '$teto_salarial' WHERE CargoID = $id";
    } else {
        $sql = "INSERT INTO cargos (Nome, TetoSalarial) VALUES ('$nome', '$teto_salarial')";
    }
 
    if ($conn->query($sql)) {
        header("Location: lista-cargos.php");
        exit();
    } else {
        echo "Erro ao salvar cargo: " . $conn->error;
    }
}
 
if ($id) {
    $sql = "SELECT * FROM cargos WHERE CargoID = $id";
    $resultado = $conn->query($sql);
    $cargo = $resultado->fetch_assoc();
}
?>
 
<main>
   <div id="cargos" class="tela">
    <form class="crud-form" method="post" action="">
      <h2><?php echo $id ? 'Editar Cargo' : 'Cadastro de Cargo'; ?></h2>
     
      <input type="text" name="nome" placeholder="Nome do Cargo" value="<?php echo $id ? $cargo['Nome'] : ''; ?>" required>
      <input type="number" name="teto_salarial" placeholder="Teto Salarial" value="<?php echo $id ? $cargo['TetoSalarial'] : ''; ?>" required>
     
      <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
    </form>
  </div>
</main>
 
<?php
// include dos arquivos
include_once './include/footer.php';
?>
 
 