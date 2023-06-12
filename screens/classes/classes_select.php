<?php
include '../../conexaoMysql.php';

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Executa a consulta SQL para selecionar os registros da tabela de alunos
$sql = "SELECT a.id, a.nome as aula, i.nome_instrutor, i.especializacao FROM aulas a INNER JOIN instrutores i ON a.instrutor_id = i.id";
$result = $conn->query($sql);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Exibe os registros em uma tabela
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a class='btn btn-primary' href='#?#=" . $row['id'] . "'><i class='bi bi-pencil-square'></i></a></td>";
        echo "<td><a class='btn btn-danger' href='#?#=" . $row['id'] . "'><i class='bi bi-trash'></i></a></td>";
        echo "<td>" . $row['aula'] . "</td>";
        echo "<td>" . $row['nome_instrutor'] . "</td>";
        echo "<td>" . $row['especializacao'] . "</td>";
    }
} else {
    echo "Nenhuma aula encontrada.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
