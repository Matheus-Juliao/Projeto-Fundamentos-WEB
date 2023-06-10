<?php
include '../../conexaoMysql.php';
ob_start(); // Inicia o buffer de saída
header('Content-Type: text/html; charset=utf-8');

// Verifica se os dados foram enviados através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $usuario_id = $_POST["usuario_id"];
    $nome = $_POST["nome_instrutor"];
    $idade = $_POST["idade"];
    $genero = $_POST["genero"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $especializacao = $_POST["especializacao"];

    // Verifica se algum dos campos obrigatórios está vazio
    if (empty($usuario_id) || empty($nome) || empty($idade) || empty($genero) || empty($telefone) || empty($endereco) || empty($especializacao)) {
        $_SESSION['mensagem-erro'] = 'Todos os campos são obrigatórios!';
        header('Location: instructors.php');
        exit();
    } else {
        // Verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Prepara e executa a consulta SQL para inserir os dados na tabela de instrutores
        $sql = "INSERT INTO instrutores (nome_instrutor, usuario_id, idade, genero, telefone, endereco, especializacao) VALUES ('$nome', '$usuario_id', '$idade', '$genero', '$telefone', '$endereco', '$especializacao')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensagem-sucesso'] = 'Instrutor cadastrado com sucesso!';
            header('Location: instructors.php');
            exit();
        } else {
            $_SESSION['mensagem-erro'] = 'Erro ao inserir o instrutor: ' . $conn->error;
            header('Location: instructors.php');
            exit();
        }
    }
}

// Recupera os alunos da tabela para exibir na tabela HTML
$sql = "SELECT i.id, i.nome_instrutor, i.idade, i.genero, i.especializacao, i.telefone, i.endereco, u.nome FROM usuarios u INNER JOIN instrutores i ON u.id = i.usuario_id";
$result = $conn->query($sql);

// Consultar os instrutores no banco de dados
$sql1 = "SELECT * FROM usuarios";
$result1 = $conn->query($sql1);

?>