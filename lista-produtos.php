<?php 
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$sql = "SELECT p.ProdutoID, p.Nome AS Produto, c.Nome as Categoria, p.Preco 
FROM produtos p 
LEFT JOIN categorias c ON p.CategoriaID = c.CategoriaID";
$result = $conn->query($sql);
?>


  <main>

    <div class="container">
        <h1>Lista de Produtos</h1>
        <a href="./salvar-produtos.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Categoria</th>
              <th>Teto Salarial</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
    <?php
    while ($dado = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $dado['ProdutoID']; ?></td> 
            <td><?php echo $dado['Produto']; ?></td> 
            <td><?php echo $dado['Categoria']; ?></td> 
            <td>R$ <?php echo number_format($dado['Preco'], 2, ',', '.'); ?></td>
            <td>
                <a href="./salvar-produtos.php?id=<?php echo $dado['ProdutoID']; ?>" class="btn btn-edit">Editar</a>
                <a href="./excluir-produtos.php?acao=excluir&id=<?php echo $dado['ProdutoID']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este cargo?');">Excluir</a>
            </td>
        </tr>
        <?php
    }
    ?>
</tbody>
        </table>
      </div> 
  </main>
  
  <?php 
  include_once './include/footer.php';
  ?>