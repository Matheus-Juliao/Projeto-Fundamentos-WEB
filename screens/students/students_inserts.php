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
        $id_plans = $_POST["id_plans"];

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
                $ultimoId = mysqli_insert_id($conn);
            } else {
                $_SESSION['mensagem-erro'] = 'Erro ao inserir o aluno: ' . $conn->error;
                header('Location: students.php');
                exit();
            }

            // Prepara e executa a consulta SQL para inserir os dados na tabela de alunos
            $sql1 = "INSERT INTO alunos_planos_de_treinamento (aluno_id, planos_de_treinamento_id) VALUES ('$ultimoId', '$id_plans');";
            if ($conn->query($sql1) === TRUE) {
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

    $sql = "SELECT a.id, a.nome_aluno, a.idade, a.genero, a.telefone, a.endereco, p.nome, p.valor
    FROM alunos a
    INNER JOIN alunos_planos_de_treinamento ap ON a.id = ap.aluno_id
    INNER JOIN planos_de_treinamento p ON ap.planos_de_treinamento_id = p.id;";
    $result = $conn->query($sql);

    $sql1 = "SELECT * FROM planos_de_treinamento";
    $result1 = $conn->query($sql1);
?>