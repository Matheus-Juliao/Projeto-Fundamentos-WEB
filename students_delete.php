<?php
    //students_delete
    require_once "conexaoMysql.php";

// Verifica se a variável 'id' está definida na URL
    if (isset($_GET['id'])) {
        // ID do registro a ser excluído
        $id = $_GET['id'];

        // Query SQL para excluir o registro
        $sql = "DELETE FROM alunos WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Erro ao excluir registro: " . mysqli_error($conn);
        }
    }
?>