<?php
include '../../conexaoMysql.php';

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Executa a consulta SQL para selecionar os registros da tabela de instrutores
$sql = "SELECT i.id, i.nome_instrutor, i.idade, i.genero, i.especializacao, i.telefone, i.endereco, u.nome FROM usuarios u INNER JOIN instrutores i ON u.id = i.usuario_id";
$result = $conn->query($sql);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Exibe os registros em uma tabela
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a class='btn btn-primary' href='instructors_update.php?id=" . $row['id'] . "'><i class='bi bi-pencil-square'></i></a></td>";
        echo "<td><a class='btn btn-danger' href='instructors_delete.php?id=" . $row['id'] . "'><i class='bi bi-trash'></i></a></td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome_instrutor'] . "</td>";
        echo "<td>" . $row['idade'] . "</td>";
        echo "<td>" . $row['genero'] . "</td>";
        echo "<td>" . $row['telefone'] . "</td>";
        echo "<td>" . $row['endereco'] . "</td>";
        echo "<td>" . $row['especializacao'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "Nenhum aluno encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
