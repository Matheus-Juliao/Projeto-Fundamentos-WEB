<?php
require_once "conexaoMysql.php";

// Conecta ao banco de dados (substitua as credenciais de conexão conforme o seu ambiente)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academia";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Executa a consulta SQL para selecionar os registros da tabela de alunos
$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);

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
        echo "</tr>";
    }
} else {
    echo "Nenhum aluno encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
