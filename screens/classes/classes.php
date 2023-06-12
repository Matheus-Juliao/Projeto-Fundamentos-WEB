
<?php 
    include '../../conexaoMysql.php';
    include '../../checkLoginScreens.php';

    $s="select * from usuarios where id='$_SESSION[id]'";
    $qu= mysqli_query($conn, $s);
    $f=mysqli_fetch_assoc($qu);

    include 'classes_inserts.php';

    if (isset($_GET["success"]) && $_GET["success"] == 0) {
        if (isset($_GET["message"])) {
            $message = $_GET["message"];
            echo $message;
        }
    }

    if (isset($_SESSION['mensagem-sucesso'])) {
        echo '
        <div style="z-index: 100000;" class="toast position-fixed top-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success">
                <strong class="me-auto">SUCESSO</strong>
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

    if (isset($_SESSION['mensagem-erro'])) {
        echo '
        <div style="z-index: 100000;" class="toast position-fixed top-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger">
                <strong class="me-auto">ERRO</strong>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ' . $_SESSION['mensagem-erro'] . '
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let toast = new bootstrap.Toast(document.querySelector(".toast"));
                toast.show();
            });
        </script>';

        unset($_SESSION['mensagem-erro']); // Limpa a mensagem da sessão
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aulas</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css">

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

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        
        <!-- Classes CSS -->
        <link rel="stylesheet" href="../../css/classes.css"> 
    </head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
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
            <a href="../../home.php" class="brand-link">
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
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Aulas</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">

                                <form method="POST" action="classes_inserts.php" class="formulario">

                                    <select name="aula">
                                        <option value="">*Nome da aula</option>
                                        <option value="Condicionamento físico">Condicionamento físico</option>
                                        <option value="Emagrecimento">Emagrecimento</option>
                                        <option value="Musculação">Musculação</option>
                                        <option value="Pilates">Pilates</option>
                                        <option value="Treinamento de força">Treinamento de força</option>
                                        <option value="Treinamento funcional">Treinamento funcional</option>
                                        <option value="Yoga">Yoga</option>
                                        <option value="Zumba">Zumba</option>
                                        <option value="Natação">Natação</option>
                                    </select>

                                    <select name="id_instrutor" id="instrutores">
                                        <option value="">*Instrutor</option>
                                        <?php 
                                            while ($instrutor = $result1->fetch_assoc()) { 
                                        ?>
                                        <option value="<?php echo $instrutor['id']; ?>">
                                            <?php echo $instrutor['nome_instrutor']; ?></option><?php } ?>
                                    </select>

                                    <!-- Botão para adicionar -->
                                    <button type="submit">Adicionar</button>
                                </form>


                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Editar</th>
                                                <th>Deletar</th>
                                                <th>Aula</th>
                                                <th>Nome do instrutor</th>
                                                <th>Especialização do instrutor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if ($result->num_rows > 0) {
                                                    // Exibe os registros em uma tabela
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td><a class='btn btn-primary' href='classes_update.php?id=" . $row['id'] . "'><i class='bi bi-pencil-square'></i></a></td>";
                                                        echo "<td><a class='btn btn-danger' href='classes_delete.php?id=" . $row['id'] . "'><i class='bi bi-trash'></i></a></td>";
                                                        echo "<td>" . $row['aula'] . "</td>";
                                                        echo "<td>" . $row['nome_instrutor'] . "</td>";
                                                        echo "<td>" . $row['especializacao'] . "</td>";
                                                    }
                                                }  else {
                                                    echo "<tr><td colspan='8'>Nenhum aluno encontrado na tabela.</td></tr>";
                                                }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2023 <a href="#">Biofitness</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
</body>

</html>