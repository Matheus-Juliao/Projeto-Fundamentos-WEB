<?php
ob_start(); // Inicia o buffer de saída

header('Content-Type: text/html; charset=utf-8');
include 'conexaoMysql.php';

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $s = "select * from usuarios where email='$email'";
    $qu = mysqli_query($conn, $s);

    if (mysqli_num_rows($qu) > 0) {
        echo '
        <div class="toast position-fixed top-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger">
                <strong class="me-auto">ERRO</strong>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Usuário já cadastrado!
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let toast = new bootstrap.Toast(document.querySelector(".toast"));
                toast.show();
            });
        </script>';

    } else {
        $i = "insert into usuarios (nome, email, senha) values ('$nome', '$email', '$senha')";
        mysqli_query($conn, $i);
        $_SESSION['mensagem-sucesso'] = 'Usuário cadastrado com sucesso!';
        header('Location: login.php');
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" style="text-align: center;">
                <img src="./images/logo-biofitness.png" style="width: 150px;">
                <table>
                    <tr>
                        <td>
                            Nome
                            <input type="text" name="nome" style="width: 250px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            E-mail
                            <input type="email" name="email" style="width: 250px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Senha
                            <input type="password" name="senha" style="width: 250px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="enviar" value="submit" class="btn mt-3"
                                style="float: right; border-color:#1c2d50;">CONFIRMAR</button>
                            <a href="login.php">
                                <div class="btn mt-3" style="float: left; border-color:#1c2d50;">VOLTAR</div>
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>

</html>