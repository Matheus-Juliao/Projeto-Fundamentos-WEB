<?php
require_once "conexaoMysql.php";

// Conecta ao banco de dados (substitua as credenciais de conexão conforme o seu ambiente)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academia";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se os dados foram enviados através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome_aluno"];
    $idade = $_POST["idade"];
    $genero = $_POST["genero"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    // Verifica se algum dos campos obrigatórios está vazio
    if (empty($nome) || empty($idade) || empty($genero) || empty($telefone) || empty($endereco)) {
        echo "Todos os campos são obrigatórios.";
        exit();
    }

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara e executa a consulta SQL para inserir os dados na tabela de alunos
    $sql = "INSERT INTO alunos (nome_aluno, idade, genero, telefone, endereco) VALUES ('$nome', '$idade', '$genero', '$telefone', '$endereco')";
    if ($conn->query($sql) === TRUE) {
        header("Location: students.php?success=1");
        exit();
    } else {
        echo "Erro ao inserir o aluno: " . $conn->error;
    }
}

// Recupera os alunos da tabela para exibir na tabela HTML
$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);

// Verifica se a operação foi bem-sucedida e exibe a mensagem apropriada
if (isset($_GET["success"]) && $_GET["success"] == 1) {
    echo "Aluno inserido com sucesso.";
}
?>



