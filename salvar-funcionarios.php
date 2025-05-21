<?php

include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$cargos = [];
$resCargos = $conn->query("SELECT CargoID, Nome FROM cargos");
while ($row = $resCargos->fetch_assoc()) {
    $cargos[] = $row;
}

$setores = [];
$resSetores = $conn->query("SELECT SetorID, Nome FROM setor");
while ($row = $resSetores->fetch_assoc()) {
    $setores[] = $row;
}

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $salario = $_POST['salario'];
    $sexo = $_POST['sexo'];
    $altura = $_POST['altura'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $cargo = $_POST['cargo'];
    $setor = $_POST['setor'];

    if ($id) {
        $sql = "UPDATE funcionarios SET Nome=?, DataNascimento=?, Email=?, Salario=?, Sexo=?, Altura=?, CPF=?, RG=?, CargoID=?, SetorID=? WHERE FuncionarioID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssiii", $nome, $data_nascimento, $email, $salario, $sexo, $altura, $cpf, $rg, $cargo, $setor, $id);
    } else {
        $sql = "INSERT INTO funcionarios (Nome, DataNascimento, Email, Salario, Sexo, Altura, CPF, RG, CargoID, SetorID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssii", $nome, $data_nascimento, $email, $salario, $sexo, $altura, $cpf, $rg, $cargo, $setor);
    }

    if ($stmt->execute()) {
        header("Location: lista-funcionarios.php");
        exit();
    } else {
        echo "Erro ao salvar funcionário: " . $stmt->error;
    }
}

$funcionario = [
    'Nome' => '',
    'DataNascimento' => '',
    'Email' => '',
    'Salario' => '',
    'Sexo' => '',
    'Altura' => '',
    'CPF' => '',
    'RG' => '',
    'CargoID' => '',
    'SetorID' => ''
];
if ($id) {
    $sql = "SELECT * FROM funcionarios WHERE FuncionarioID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $funcionario = $resultado->fetch_assoc();
}
?>

<main>
    <div class="container">
        <h2><?php echo $id ? 'Editar Funcionário' : 'Cadastro de Funcionário'; ?></h2>
        <form class="crud-form" method="POST" action="">
            <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($funcionario['Nome']); ?>" required>
            <input type="date" name="data_nascimento" placeholder="Data de Nascimento" value="<?php echo htmlspecialchars($funcionario['DataNascimento']); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($funcionario['Email']); ?>" required>
            <input type="number" name="salario" placeholder="Salário" value="<?php echo htmlspecialchars($funcionario['Salario']); ?>" required>
            <select name="sexo" required>
                <option value="">Sexo</option>
                <option value="M" <?php echo ($funcionario['Sexo'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
                <option value="F" <?php echo ($funcionario['Sexo'] == 'F') ? 'selected' : ''; ?>>Feminino</option>
            </select>
            <input type="number" name="altura" placeholder="Altura (cm)" value="<?php echo htmlspecialchars($funcionario['Altura']); ?>" required>
            <input type="text" name="cpf" placeholder="CPF" value="<?php echo htmlspecialchars($funcionario['CPF']); ?>" required>
            <input type="text" name="rg" placeholder="RG" value="<?php echo htmlspecialchars($funcionario['RG']); ?>" required>
            <select name="cargo" required>
                <option value="">Selecione o Cargo</option>
                <?php foreach ($cargos as $cargoItem): ?>
                    <option value="<?php echo $cargoItem['CargoID']; ?>" <?php echo ($funcionario['CargoID'] == $cargoItem['CargoID']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cargoItem['Nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="setor" required>
                <option value="">Selecione o Setor</option>
                <?php foreach ($setores as $setorItem): ?>
                    <option value="<?php echo $setorItem['SetorID']; ?>" <?php echo ($funcionario['SetorID'] == $setorItem['SetorID']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($setorItem['Nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
        </form>
    </div>
</main>

<?php
include_once './include/footer.php';
?>