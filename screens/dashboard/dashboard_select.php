<?php
include '../../conexaoMysql.php';

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Executa a consulta SQL
$sql = "SELECT COUNT(*) as total_alunos FROM alunos";
$result = $conn->query($sql);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Obtém o número de alunos cadastrados
    $row = $result->fetch_assoc();
    $totalAlunos = $row["total_alunos"];
} else {
    $totalAlunos = 0;
}

// Executa a consulta SQL
$sql = "SELECT COUNT(*) as total_instrutores FROM instrutores";
$result = $conn->query($sql);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Obtém o número de alunos cadastrados
    $row = $result->fetch_assoc();
    $total_instrutores = $row["total_instrutores"];
} else {
    $total_instrutores = 0;
}

// Select para gráfico de Alunos/Planos
$sql = "SELECT p.nome AS plano, COUNT(ap.aluno_id) AS num_alunos
        FROM planos_de_treinamento p
        LEFT JOIN alunos_planos_de_treinamento ap ON p.id = ap.planos_de_treinamento_id
        GROUP BY p.nome";

// Executar a consulta e obter os resultados
$result = mysqli_query($conn, $sql);

// Criar um array para armazenar os dados do gráfico
$data = array();
$data[] = ['Plano', 'Número de Alunos'];

// Iterar sobre os resultados e adicionar os dados ao array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [$row['plano'], (int)$row['num_alunos']];
}

// Converter o array em formato JSON
$jsonData = json_encode($data);

// Incluir a biblioteca do Google Charts
echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';

// Carregar a biblioteca e definir a função de callback
echo '<script type="text/javascript">
      google.charts.load("current", {"packages":["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(' . $jsonData . ');

        var options = {
          title: "Número de Alunos por Plano de Treinamento",
          pieHole: 0.0,
        };

        var chart = new google.visualization.PieChart(document.getElementById("chart_div"));
        chart.draw(data, options);
      }
      </script>';

// Fecha a conexão com o banco de dados
$conn->close();
?>
