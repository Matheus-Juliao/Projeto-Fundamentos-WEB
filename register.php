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