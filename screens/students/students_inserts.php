<?php
include '../../conexaoMysql.php';
ob_start(); // Inicia o buffer de saída
header('Content-Type: text/html; charset=utf-8');

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
        $_SESSION['mensagem-erro'] = 'Todos os campos são obrigatórios!';
        header('Location: students.php');
        exit();
    } else {
        // Verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Prepara e executa a consulta SQL para inserir os dados na tabela de alunos
        $sql = "INSERT INTO alunos (nome_aluno, idade, genero, telefone, endereco) VALUES ('$nome', '$idade', '$genero', '$telefone', '$endereco')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensagem-sucesso'] = 'Aluno cadastrado com sucesso!';
            header('Location: students.php');
            exit();
        } else {
            $_SESSION['mensagem-erro'] = 'Erro ao inserir o aluno: ' . $conn->error;
            header('Location: students.php');
            exit();
        }
    }
}

// Recupera os alunos da tabela para exibir na tabela HTML
$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);

?>