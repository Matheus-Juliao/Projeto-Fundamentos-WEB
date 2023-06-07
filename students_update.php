

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
    $id = $_POST["id"];
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

    // Prepara e executa a consulta SQL para atualizar os dados na tabela de alunos
    $sql = "UPDATE alunos SET nome_aluno='$nome', idade='$idade', genero='$genero', telefone='$telefone', endereco='$endereco' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: students.php?success=1");
        exit();
    } else {
        echo "Erro ao atualizar o aluno: " . $conn->error;
    }
}

// Recupera o ID do aluno a ser atualizado da URL
$id = $_GET["id"];

// Recupera os dados do aluno a partir do ID
$sql = "SELECT * FROM alunos WHERE id='$id'";
$result = $conn->query($sql);

// Verifica se o aluno existe
if ($result->num_rows > 0) {
    $aluno = $result->fetch_assoc();
} else {
    echo "Aluno não encontrado.";
    exit();
}

?>

<!-- Código HTML para exibir o formulário de atualização -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/students.css">
    <title>Atualizar Aluno</title>
</head>
<body>
    <h2>Atualizar Aluno</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $aluno['id']; ?>">
        Nome: <input type="text" name="nome_aluno" value="<?php echo $aluno['nome_aluno']; ?>"><br><br>
        Idade: <input type="text" name="idade" value="<?php echo $aluno['idade']; ?>"><br><br>
        Gênero: <input type="text" name="genero" value="<?php echo $aluno['genero']; ?>"><br><br>
        Telefone: <input type="text" name="telefone" value="<?php echo $aluno['telefone']; ?>"><br><br>
        Endereço: <input type="text" name="endereco" value="<?php echo $aluno['endereco']; ?>"><br><br>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
