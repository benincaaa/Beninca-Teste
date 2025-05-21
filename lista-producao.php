<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
 
$sql = "SELECT p.ProducaoID, pr.Nome AS Produto, f.Nome AS Funcionario, c.Nome AS Cliente, p.DataProducao, p.DataEntrega
        FROM producao p
        LEFT JOIN produtos pr ON p.ProdutoID = pr.ProdutoID
        LEFT JOIN funcionarios f ON p.FuncionarioID = f.FuncionarioID
        LEFT JOIN clientes c ON p.ClienteID = c.ClienteID"; 
$resultado = $conn->query($sql);
?>
 
<main>
  <div class="container">
      <h1>Lista de Produções</h1>
      <a href="salvar-producao.php" class="btn btn-add">Incluir</a>
     
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Funcionário</th>
            <th>Cliente</th>
            <th>Data Produção</th>
            <th>Data Entrega</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($dado = $resultado->fetch_assoc()) {
           
          ?>
          <tr>
            <td><?php echo $dado['ProducaoID']; ?></td>
            <td><?php echo $dado['Produto']; ?></td>
            <td><?php echo $dado['Funcionario']; ?></td>
            <td><?php echo $dado['Cliente']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($dado['DataProducao'])); ?></td>
            <td><?php echo date('d/m/Y', strtotime($dado['DataEntrega'])); ?></td>
<td>
  <a href="salvar-producao.php?id=<?php echo $dado['ProducaoID']; ?>" class="btn btn-edit">Editar</a>
  <a href="excluir-producao.php?id=<?php echo $dado['ProducaoID']; ?>" class="btn btn-delete">Excluir</a>
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
 
 