<?php
include '../../conexaoMysql.php';
ob_start(); // Inicia o buffer de saída
header('Content-Type: text/html; charset=utf-8');

// Verifica se os dados foram enviados através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $valor = $_POST["valor"];


    // Verifica se algum dos campos obrigatórios está vazio
    if (empty($nome) || empty($descricao)  || empty($valor)) {
        $_SESSION['mensagem-erro'] = 'Todos os campos são obrigatórios!';
        header('Location: plans.php');
        exit();
    } else {
        // Verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Prepara e executa a consulta SQL para inserir os dados na tabela de instrutores
        $sql = "INSERT INTO planos_de_treinamento (nome, descricao, valor) VALUES ('$nome', '$descricao', '$valor')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensagem-sucesso'] = 'Plano cadastrado com sucesso!';
            header('Location: plans.php');
            exit();
        } else {
            $_SESSION['mensagem-erro'] = 'Erro ao inserir o plano: ' . $conn->error;
            header('Location: plans.php');
            exit();
        }
    }
}

// Recupera os alunos da tabela para exibir na tabela HTML
$sql = "SELECT * FROM planos_de_treinamento";
$result = $conn->query($sql);

?>