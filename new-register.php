<?php
header('Content-Type: text/html; charset=utf-8');
include 'conexaoMysql.php';
//include 'checkLogin.php';

if(isset($_POST['sub'])){
    
    $usuario=$_POST['nome'];

    $i = "insert into usuarios (nome) values ('$usuario')";
    mysqli_query($con, $i);
}
?>

<?php
    header('Content-Type: text/html; charset=utf-8');
    include 'conexaoMysql.php';
    if(isset($_POST['sub'])){
        $n=$_POST['nome'];
        $e=$_POST['email'];
        $s=$_POST['senha'];

        if($_FILES['f1']['name']){
            move_uploaded_file($_FILES['f1']['tmp_name'], "image/".$_FILES['f1']['name']);
            $img="image/".$_FILES['f1']['name'];
        }
        $i="insert into usuarios(nome,email,senha)value('$n','$e','$s')";
        mysqli_query($con, $i);
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
                            <input type="text" name="user" style="width: 250px;">
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
                            <input type="password" name="password" style="width: 250px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit" value="submit" class="btn mt-3"
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

</html>