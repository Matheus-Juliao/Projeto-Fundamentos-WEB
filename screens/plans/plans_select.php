<?php
include '../../conexaoMysql.php';

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Executa a consulta SQL para selecionar os registros da tabela de planos
$sql = "SELECT * FROM planos_de_treinamento";
$result = $conn->query($sql);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Exibe os registros em uma tabela
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a class='btn btn-primary' href='plans_update.php?id=" . $row['id'] . "'><i class='bi bi-pencil-square'></i></a></td>";
        echo "<td><a class='btn btn-danger' href='plans_delete.php?id=" . $row['id'] . "'><i class='bi bi-trash'></i></a></td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['descricao'] . "</td>";
        echo "<td>" . $row['valor'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "Nenhum plano encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
