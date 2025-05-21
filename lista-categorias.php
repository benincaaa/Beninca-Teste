<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
 
$sql = "SELECT * FROM categorias"; 
$resultado = $conn->query($sql);
?>
 
<main>
  <div class="container">
      <h1>Lista de Categorias</h1>
      <a href="salvar-categorias.php" class="btn btn-add">Incluir</a>
     
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($dado = $resultado->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $dado['CategoriaID']; ?></td>
            <td><?php echo $dado['Nome']; ?></td>
            <td>
              <a href="salvar-categorias.php?id=<?php echo $dado['CategoriaID']; ?>" class="btn btn-edit">Editar</a>
             
              <a href="excluir-categorias.php?id=<?php echo $dado['CategoriaID']; ?>" class="btn btn-delete">Excluir</a>
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
 