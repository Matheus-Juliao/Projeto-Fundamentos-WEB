<?php
    include 'conexaoMysql.php';

    if (isset($_SESSION['mensagem-sucesso'])) {
        echo '
        <div class="toast position-fixed top-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success">
                <strong class="me-auto">SUCCESSO</strong>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ' . $_SESSION['mensagem-sucesso'] . '
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let toast = new bootstrap.Toast(document.querySelector(".toast"));
                toast.show();
            });
        </script>';
    
        unset($_SESSION['mensagem-sucesso']); // Limpa a mensagem da sessão

    }

    // is set 
    if (isset($_POST['enviar'])) {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        $s = "select * from usuarios where nome='$nome' and senha= '$senha'";
        $qu = mysqli_query($conn, $s);
        if (mysqli_num_rows($qu) > 0) {
            $f = mysqli_fetch_assoc($qu);
            $_SESSION['id'] = $f['id'];
            header('location: home.php');
        } else {
            echo '
            <div class="toast position-fixed top-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger">
                    <strong class="me-auto">ERROR</strong>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Usuário ou senha incorreta!
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let toast = new bootstrap.Toast(document.querySelector(".toast"));
                    toast.show();
                });
            </script>';
        }
    }
    ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
                            Username
                            <input type="text" name="nome" style="width: 250px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            password
                            <input type="password" name="senha" style="width: 250px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="new-register.php">Não tem uma conta? Cadastre-se</a>
                            <button type="submit" name="enviar" value="submit" class="btn mt-3"
                                style="float: right; border-color:#1c2d50;">LOGIN</button>
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