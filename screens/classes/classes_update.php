<?php
    include '../../conexaoMysql.php';
    include '../../checkLoginScreens.php';

    $s="select * from usuarios where id='$_SESSION[id]'";
    $qu= mysqli_query($conn, $s);
    $f=mysqli_fetch_assoc($qu);
    
    include '../../conexaoMysql.php';

    // Verifica se os dados foram enviados através do método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera os dados do formulário
        $id = $_POST["id"];
        $aula = $_POST["aula"];
        $id_instrutor = $_POST["id_instrutor"];


        // Verifica se algum dos campos obrigatórios está vazio
        if (empty($id) || empty($aula) || empty($id_instrutor)) {
            $_SESSION['mensagem-erro'] = 'Todos os campos são obrigatórios.: ' . $conn->error;
            exit();
        }

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

        // Prepara e executa a consulta SQL para atualizar os dados na tabela de aulas
        $sql = "UPDATE aulas SET nome='$aula', instrutor_id='$id_instrutor' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensagem-sucesso'] = 'Aluno editado com sucesso!';
            header('Location: classes.php');
            exit();
        } else {
            $_SESSION['mensagem-erro'] = 'Erro ao atualizar o aluno: ' . $conn->error;
        }
    }

    // Recupera o ID do aluno a ser atualizado da URL
    $id = $_GET["id"];

    // Recupera os dados da aula a partir do ID
    $sql = "SELECT id, nome as aula, instrutor_id FROM aulas WHERE id='$id'";
    $result = $conn->query($sql);

    // Consultar os instrutores no banco de dados
    $sql1 = "SELECT id, nome_instrutor FROM instrutores";
    $result1 = $conn->query($sql1);

    // Verifica se a aula existe
    if ($result->num_rows > 0) {
        $aula = $result->fetch_assoc();
        $instrutor_id = $aula['instrutor_id'];
        $aulaSelecionada = $aula['aula'];
    } else {
        $_SESSION['mensagem-erro'] = 'Aula não encontrada!';
        exit();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Atualizar Aula</title>
    <link rel="stylesheet" href="../../css/classes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../home.php" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../../images/logo-biofitness.png" alt="logo-biofitness-2" class="img-circle elevation-3"
                    style="opacity: .8; max-height: 33px;">
                <span class="brand-text font-weight-light">Bio Fitness</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- <img src="<?php echo $f['image'];?>" width="100px" height="100px" class="img-circle elevation-2" alt="User Image"> -->
                    </div>
                    <div class="info m-auto">
                        <!-- <a href="#" class="d-block"><?php echo $f['name'];?></a> -->
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../students/students.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Alunos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="classes.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Aulas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../instructors/instructors.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Instrutores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../plans/plans.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Planos de treinamento</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../dashboard/dashboard.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboards</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../reports/reports.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Exportação de dados</p>
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item">
                                    <a href="../../logout.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sair</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                <h2>Atualizar Aula</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="id" value="<?php echo $aula['id']; ?>">
                        Nome da Aula:   <select name="aula">
                                            <option value="Condicionamento físico"<?php if ($aulaSelecionada == 'Condicionamento físico') echo ' selected'; ?>>Condicionamento físico</option>
                                            <option value="Emagrecimento"<?php if ($aulaSelecionada == 'Emagrecimento') echo ' selected'; ?>>Emagrecimento</option>
                                            <option value="Musculação"<?php if ($aulaSelecionada == 'Musculação') echo ' selected'; ?>>Musculação</option>
                                            <option value="Pilates"<?php if ($aulaSelecionada == 'Pilates') echo ' selected'; ?>>Pilates</option>
                                            <option value="Treinamento de força"<?php if ($aulaSelecionada == 'Treinamento de força') echo ' selected'; ?>>Treinamento de força</option>
                                            <option value="Treinamento funcional"<?php if ($aulaSelecionada == 'Treinamento funcional') echo ' selected'; ?>>Treinamento funcional</option>
                                            <option value="Yoga"<?php if ($aulaSelecionada == 'Yoga') echo ' selected'; ?>>Yoga</option>
                                            <option value="Zumba"<?php if ($aulaSelecionada == 'Zumba') echo ' selected'; ?>>Zumba</option>
                                            <option value="Natação"<?php if ($aulaSelecionada == 'Natação') echo ' selected'; ?>>Natação</option>
                                        </select>
                        Instrutor: <select class="instrutor" name="id_instrutor" id="instrutores">
                            <?php
                            while ($instrutor = $result1->fetch_assoc()) {
                                $selected = ($instrutor['id'] == $instrutor_id) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $instrutor['id']; ?>" <?php echo $selected; ?>>
                                    <?php echo $instrutor['nome_instrutor']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Atualizar">
                    </form>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2023 <a href="#">Biofitness</a>.</strong> All rights
        reserved.
    </footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>

</html>