<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
 
$id = isset($_GET['id']) ? $_GET['id'] : null;
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
 
    if ($id) {
        $sql = "UPDATE categorias SET Nome = '$nome', Descricao = '$descricao' WHERE CategoriaID = $id";
    } else {
        $sql = "INSERT INTO categorias (Nome, Descricao) VALUES ('$nome', '$descricao')";
    }
 
    if ($conn->query($sql)) {
        header("Location: lista-categorias.php");
        exit();
    } else {
        echo "Erro ao salvar categoria: " . $conn->error;
    }
}
 
if ($id) {
    $sql = "SELECT * FROM categorias WHERE CategoriaID = $id";
    $resultado = $conn->query($sql);
    $categoria = $resultado->fetch_assoc();
}
?>
 
<main>
   <div id="categoriaID" class="tela">
      <form class="crud-form" method="POST" action="">
        <h2><?php echo $id ? 'Editar Categoria' : 'Cadastro de Categoria'; ?></h2>
       
        <input type="text" name="nome" placeholder="Nome da Categoria" value="<?php echo $id ? $categoria['Nome'] : ''; ?>" required>
        <textarea name="descricao" placeholder="Descrição" required><?php echo $id ? $categoria['Descricao'] : ''; ?></textarea>
       
        <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
      </form>
   </div>
</main>
 
<?php
include_once './include/footer.php';
?>