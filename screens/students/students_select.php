<?php
include '../../conexaoMysql.php';

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Executa a consulta SQL para selecionar os registros da tabela de alunos
$sql = "SELECT a.id, a.nome_aluno, a.idade, a.genero, a.telefone, a.endereco, p.id, p.nome, p.valor
FROM alunos a
INNER JOIN alunos_planos_de_treinamento ap ON a.id = ap.aluno_id
INNER JOIN planos_de_treinamento p ON ap.planos_de_treinamento_id = p.id;";
$result = $conn->query($sql);

$sql1 = "SELECT * FROM planos_de_treinamento";
$result1 = $conn->query($sql1);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Exibe os registros em uma tabela
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a class='btn btn-primary' href='#?#=" . $row['id'] . "'><i class='bi bi-pencil-square'></i></a></td>";
        echo "<td><a class='btn btn-danger' href='#?#=" . $row['id'] . "'><i class='bi bi-trash'></i></a></td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['idade'] . "</td>";
        echo "<td>" . $row['genero'] . "</td>";
        echo "<td>" . $row['telefone'] . "</td>";
        echo "<td>" . $row['endereco'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['valor'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "Nenhum aluno encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
