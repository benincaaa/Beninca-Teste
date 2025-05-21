<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$sql1 = "SELECT s.Nome AS Setor, COUNT(f.FuncionarioID) AS TotalFuncionarios
        FROM setor s
        LEFT JOIN funcionarios f ON f.SetorID = s.SetorID
        GROUP BY s.SetorID, s.Nome";
$res1 = $conn->query($sql1);
$setores = [];
$totaisSetor = [];
while ($row = $res1->fetch_assoc()) {
    $setores[] = $row['Setor'];
    $totaisSetor[] = $row['TotalFuncionarios'];
}

$sql2 = "SELECT c.Nome AS Cargo, COUNT(f.FuncionarioID) AS TotalFuncionarios
        FROM cargos c
        LEFT JOIN funcionarios f ON f.CargoID = c.CargoID
        GROUP BY c.CargoID, c.Nome";
$res2 = $conn->query($sql2);
$cargos = [];
$totaisCargo = [];
while ($row = $res2->fetch_assoc()) {
    $cargos[] = $row['Cargo'];
    $totaisCargo[] = $row['TotalFuncionarios'];
}

$sql3 = "SELECT COUNT(*) AS Total FROM funcionarios";
$res3 = $conn->query($sql3);
$totalFuncionarios = $res3->fetch_assoc()['Total'];

$sql4 = "SELECT COUNT(*) AS Total FROM setor";
$res4 = $conn->query($sql4);
$totalSetores = $res4->fetch_assoc()['Total'];
$sql5 = "SELECT COUNT(*) AS Total FROM cargos";
$res5 = $conn->query($sql5);
$totalCargos = $res5->fetch_assoc()['Total'];

$sql6 = "SELECT c.Nome AS Categoria, COUNT(p.ProdutoID) AS TotalProdutos
        FROM categorias c
        LEFT JOIN produtos p ON p.CategoriaID = c.CategoriaID
        GROUP BY c.CategoriaID, c.Nome";
$res6 = $conn->query($sql6);
$categorias = [];
$totaisProdutos = [];
while ($row = $res6->fetch_assoc()) {
    $categorias[] = $row['Categoria'];
    $totaisProdutos[] = $row['TotalProdutos'];
}
?>
<main>
    <div class="container" style="max-width:900px; margin:40px auto;">
        <h2>Relatório Geral</h2>
        <div style="display:flex; gap:30px; margin-bottom:30px;">
            <div style="background:#f8f9fa; padding:18px 32px; border-radius:10px;">
                <strong>Total de Funcionários:</strong><br>
                <span style="font-size:2em;"><?php echo $totalFuncionarios; ?></span>
            </div>
            <div style="background:#f8f9fa; padding:18px 32px; border-radius:10px;">
                <strong>Total de Setores:</strong><br>
                <span style="font-size:2em;"><?php echo $totalSetores; ?></span>
            </div>
            <div style="background:#f8f9fa; padding:18px 32px; border-radius:10px;">
                <strong>Total de Cargos:</strong><br>
                <span style="font-size:2em;"><?php echo $totalCargos; ?></span>
            </div>
        </div>

        <h3>Funcionários por Setor</h3>
        <canvas id="graficoSetores"></canvas>
        <hr style="margin:40px 0;">

        <h3>Funcionários por Cargo</h3>
        <canvas id="graficoCargos"></canvas>
        <hr style="margin:40px 0;">

        <h3>Produtos por Categoria</h3>
        <canvas id="graficoProdutos"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Funcionários por Setor
    new Chart(document.getElementById('graficoSetores').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($setores); ?>,
            datasets: [{
                label: 'Total de Funcionários',
                data: <?php echo json_encode($totaisSetor); ?>,
                backgroundColor: '#007bff'
            }]
        },
        options: {responsive:true, plugins:{legend:{display:false}}}
    });

    // Funcionários por Cargo
    new Chart(document.getElementById('graficoCargos').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($cargos); ?>,
            datasets: [{
                label: 'Total de Funcionários',
                data: <?php echo json_encode($totaisCargo); ?>,
                backgroundColor: '#28a745'
            }]
        },
        options: {responsive:true, plugins:{legend:{display:false}}}
    });

    // Produtos por Categoria (exemplo)
    new Chart(document.getElementById('graficoProdutos').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($categorias); ?>,
            datasets: [{
                label: 'Total de Produtos',
                data: <?php echo json_encode($totaisProdutos); ?>,
                backgroundColor: '#ffc107'
            }]
        },
        options: {responsive:true, plugins:{legend:{display:false}}}
    });
    </script>
</main>
<?php include_once './include/footer.php'; ?>