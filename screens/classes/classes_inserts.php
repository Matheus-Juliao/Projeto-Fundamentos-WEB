<?php
include '../../conexaoMysql.php';
ob_start(); // Inicia o buffer de saída
header('Content-Type: text/html; charset=utf-8');

// Verifica se os dados foram enviados através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $id_intrutor = $_POST["id_instrutor"];
    $aula = $_POST["aula"];

    // Verifica se algum dos campos obrigatórios está vazio
    if (empty($id_intrutor) || empty($aula)) {
        $_SESSION['mensagem-erro'] = 'Todos os campos são obrigatórios!';
        header('Location: classes.php');
        exit();
    } else {
        // Verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        //Verifica se já existe a aula
        $sql = "SELECT * FROM aulas WHERE nome='$aula'";
        $resultado = $conn->query($sql);
        
        if ($resultado && $resultado->num_rows > 0) {
            $_SESSION['mensagem-erro'] = 'Aula já cadastrada!';
            header('Location: classes.php');
            exit();
        }

        // Prepara e executa a consulta SQL para inserir os dados na tabela de alunos
        $sql1 = "INSERT INTO aulas (nome, instrutor_id) VALUES ('$aula', '$id_intrutor')";
        if ($conn->query($sql1) === TRUE) {
            $_SESSION['mensagem-sucesso'] = 'Aula cadastrada com sucesso!';
            header('Location: classes.php');
            exit();
        } else {
            $_SESSION['mensagem-erro'] = 'Erro ao inserir aula: ' . $conn->error;
            header('Location: classes.php');
            exit();
        }
    }
}

// Recupera os alunos da tabela para exibir na tabela HTML
$sql = "SELECT a.id, a.nome as aula, i.nome_instrutor, i.especializacao FROM aulas a INNER JOIN instrutores i ON a.instrutor_id = i.id";
$result = $conn->query($sql);

// Consultar os instrutores no banco de dados
$sql1 = "SELECT id, nome_instrutor FROM instrutores";
$result1 = $conn->query($sql1);

?>