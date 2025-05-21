<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Empresarial</title>
  <link rel="stylesheet" href="./assets/style.css">
  <style>
      .mensagem-erro {
    color: red;
    font-weight: bold;
    text-align: center;
    margin-top: 10px;
  }
  </style>
  
</head>
<body>
  <header>
    <h1>Sistema de Gestão de Empresa</h1>
  </header>

  
  <main>

    <div id="login" class="tela active">
    <form class="login-form" action="processar-login.php" method="POST">
    <h2>Login</h2>
    <input type="text" name="usuario" placeholder="Usuário ou Email" required />
    <input type="password" name="senha" placeholder="Senha" required />
    <button type="submit">Entrar</button>
</form>
<?php
if (isset($_GET['erro']) && $_GET['erro'] == 1) {
    echo "<p class='mensagem-erro'>Usuário ou senha inválidos!</p>";
}
?>
    
    </div>

  </main>


  <script src="./assets/script.js"></script>
</body>
</html>

<?php
if (isset($_GET['cadastro']) && $_GET['cadastro'] == 1) {
    echo "<p style='color: green; text-align: center;'>Cadastro realizado com sucesso! Faça login.</p>";
}
?>

