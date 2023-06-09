<?php
    //classes_delete
    include '../../conexaoMysql.php';

// Verifica se a variável 'id' está definida na URL
    if (isset($_GET['id'])) {
        // ID do registro a ser excluído
        $id = $_GET['id'];

        // Query SQL para excluir o registro
        $sql = "DELETE FROM aulas WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['mensagem-sucesso'] = 'Registro excluído com sucesso!';
            header('Location: classes.php');
            exit();
        } else {
            $_SESSION['mensagem-erro'] = 'Erro ao excluir registro: ' . $conn->error;
        }
    }
?>