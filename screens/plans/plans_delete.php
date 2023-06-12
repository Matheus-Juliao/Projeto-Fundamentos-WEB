<?php
    //instuctors_delete
    include '../../conexaoMysql.php';

// Verifica se a variável 'id' está definida na URL
    if (isset($_GET['id'])) {
        // ID do registro a ser excluído
        $id = $_GET['id'];

        // Query SQL para excluir o registro
        $sql = "DELETE FROM planos_de_treinamento WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['mensagem-sucesso'] = 'Registro excluído com sucesso!';
            header('Location: plans.php');
            exit();
        } else {
            $sql1 = "SELECT * FROM alunos_planos_de_treinamento WHERE planos_de_treinamento_id=$id";
            if(mysqli_query($conn, $sql1)) {
                $_SESSION['mensagem-erro'] = 'Para excluir o plano é necessário desviculá-los dos alunos!';
                header('Location: plans.php');
                exit();
            }

            $_SESSION['mensagem-erro'] = 'Erro ao excluir registro: ' . $conn->error;
            header('Location: plans.php');
            exit();
        }
    }
?>