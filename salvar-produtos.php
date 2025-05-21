<?php

include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
 

$id = isset($_GET['id']) ? $_GET['id'] : null;
 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $peso = $_POST['peso'];
    $descricao = $_POST['descricao'];
    $categoria_id = $_POST['categoria'];
 

    if ($id) {
 
        $sql = "UPDATE produtos SET Nome = '$nome', Preco = '$preco', Peso = '$peso', Descricao = '$descricao', CategoriaID = '$categoria_id' WHERE ProdutoID = $id";
    } else {

        $sql = "INSERT INTO produtos (Nome, Preco, Peso, Descricao, CategoriaID) VALUES ('$nome', '$preco', '$peso', '$descricao', '$categoria_id')";
    }
 
   
    if ($conn->query($sql)) {
  
        header("Location: lista-produtos.php");
        exit();
    } else {
        echo "Erro ao salvar produto: " . $conn->error;
    }
}
 

if ($id) {
    $sql = "SELECT * FROM produtos WHERE ProdutoID = $id";
    $resultado = $conn->query($sql);
    $produto = $resultado->fetch_assoc();
}
 

$sql_categorias = "SELECT CategoriaID, Nome FROM categorias";
$resultado_categorias = $conn->query($sql_categorias);
?>
 
<main>
    <div id="produtos" class="tela">
        <form class="crud-form" action="" method="post">
          <h2><?php echo $id ? 'Editar Produto' : 'Cadastro de Produto'; ?></h2>
 
          <input type="text" name="nome" placeholder="Nome do Produto" value="<?php echo $id ? $produto['Nome'] : ''; ?>" required>
 
          <input type="number" name="preco" placeholder="Preço" value="<?php echo $id ? $produto['Preco'] : ''; ?>" required>
 
          <input type="number" name="peso" placeholder="Peso (g)" value="<?php echo $id ? $produto['Peso'] : ''; ?>" required>
 
          <textarea name="descricao" placeholder="Descrição" required><?php echo $id ? $produto['Descricao'] : ''; ?></textarea>
 
          <select name="categoria" required>
            <option value="">Categoria</option>
            <?php while ($categoria = $resultado_categorias->fetch_assoc()) { ?>
              <option value="<?php echo $categoria['CategoriaID']; ?>" <?php echo ($id && $produto['CategoriaID'] == $categoria['CategoriaID']) ? 'selected' : ''; ?>>
                <?php echo $categoria['Nome']; ?>
              </option>
            <?php } ?>
          </select>
 
          <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
        </form>
    </div>
</main>
 
<?php
// include dos arquivos
include_once './include/footer.php';
?>
 
 