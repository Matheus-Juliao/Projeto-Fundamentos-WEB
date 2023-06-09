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



// Consulta SQL para obter os dados da tabela t_inscrições
$sqlinsc = "SELECT COUNT(*) as total, status FROM t_inscrições GROUP BY status";

// Executar a consulta
$resultinsc = $conn->query($sqlinsc);

// Array para armazenar os rótulos
$labels = array();
// Array para armazenar os dados
$data = array();

// Verificar se a consulta retornou resultados
if ($resultinsc->num_rows > 0) {
    // Percorrer os resultados e armazenar os valores nas arrays
    while ($rowinsc = $resultinsc->fetch_assoc()) {
        $labels[] = $rowinsc["status"];
        $data[] = $rowinsc["total"];
    }
}


// Executa a consulta SQL para selecionar os registros da tabela de alunos
// $sql = "SELECT * FROM alunos";
// $result = $conn->query($sql);


// Verifica se a consulta retornou algum resultado
// if ($result->num_rows > 0) {
//     // Exibe os registros em uma tabela
//     while ($row = $result->fetch_assoc()) {
//         echo "<tr>";
//         echo "<td><a class='btn btn-primary' href='#?#=" . $row['id'] . "'><i class='bi bi-pencil-square'></i></a></td>";
//         echo "<td><a class='btn btn-danger' href='#?#=" . $row['id'] . "'><i class='bi bi-trash'></i></a></td>";
//         echo "<td>" . $row['nome'] . "</td>";
//         echo "<td>" . $row['idade'] . "</td>";
//         echo "<td>" . $row['genero'] . "</td>";
//         echo "<td>" . $row['telefone'] . "</td>";
//         echo "<td>" . $row['endereco'] . "</td>";
//         echo "</tr>";
//     }
// } else {
//     echo "Nenhum aluno encontrado.";
// }

// Fecha a conexão com o banco de dados
$conn->close();
?>
