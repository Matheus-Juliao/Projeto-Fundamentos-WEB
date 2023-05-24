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
                                <input type="text" name="user" style="width: 250px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                password
                                <input type="password" name="pass" style="width: 250px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="cadastro.php">Não tem uma conta? Cadastre-se</a>
                                <button type="submit" name="sub" value="submit" class="btn mt-3"
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