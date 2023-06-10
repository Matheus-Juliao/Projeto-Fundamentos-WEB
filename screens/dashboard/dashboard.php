<?php include 'dashboard_select.php';

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
    <title>AdminLTE 3 | Simple Tables</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <!-- dashboard CSS -->
    <link rel="stylesheet" href="../../css/dashboard.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .ver-mais-link {
            color: black;
        }

        .larger-card {
            width: 75%;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
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
                        <!-- <img src="<?php echo $f['image']; ?>" width="100px" height="100px" class="img-circle elevation-2" alt="User Image"> -->
                    </div>
                    <div class="info m-auto">
                        <!-- <a href="#" class="d-block"><?php echo $f['name']; ?></a> -->
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="students.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Alunos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Aulas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Instrutores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Planos de treinamento</p>
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link">
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
                            <h1>Dashboards</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Colocar o código aqui -->

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?php echo $totalAlunos; ?>
                            </h3>
                            <p>Alunos</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="http://localhost/Projeto-Fundamentos-WEB/screens/students/students.php"
                            class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?php echo $totalAlunos; ?>
                            </h3>

                            <p>Intrutores</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="http://localhost/Projeto-Fundamentos-WEB/screens/instructors/instructors.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- <div class="col-lg-3 col-6"> -->
                <!-- small box -->
                <!-- <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>Teste</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div> -->
                <!-- </div> -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row d-flex justify-content-between">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable larger-card">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Inscrições
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                    </li> -->
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="card-body">
                                    <canvas id="inscricoesChart"></canvas>
                                </div>
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative; height: 300px;">
                                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <div class="row">
                                    <?php
                                    $ano = date('Y'); // Obter o ano atual
                                    
                                    // Loop para percorrer os meses
                                    for ($mes = 1; $mes <= 12; $mes++) {
                                        $nome_mes = date('F', mktime(0, 0, 0, $mes, 1)); // Obter o nome do mês
                                    
                                        // Exibir o nome do mês
                                        echo '<div class="col text-center">' . $nome_mes . '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-7 connectedSortable larger-card">

                    <!-- Map card -->
                    <div class="card bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Planos Favoritos!
                            </h3>
                            <!-- card tools -->
                            <!-- <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                    <i class="far fa-calendar-alt"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div> -->
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                        </div>
                        <!-- /.card-body-->
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div class="box-planos">
                                        <h4>Plano 1</h4>
                                        <p>Musculação</p>
                                        <a class="ver-mais-link"
                                            href="http://localhost/Projeto-Fundamentos-WEB/screens/training-plans/training-plans.php"
                                            class="small-box-footer">Ver mais <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div class="box-planos">
                                        <h4>Plano 2</h4>
                                        <p>Natação</p>
                                        <a class="ver-mais-link"
                                            href="http://localhost/Projeto-Fundamentos-WEB/screens/training-plans/training-plans.php"
                                            class="small-box-footer">Ver mais <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div class="box-planos">
                                        <h4>Plano 3</h4>
                                        <p>Musculação e Natação</p>
                                        <a class="ver-mais-link"
                                            href="http://localhost/Projeto-Fundamentos-WEB/screens/training-plans/training-plans.php"
                                            class="small-box-footer">Ver mais <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->

                </section>
                <!-- right col -->

                <!-- Colocar o código aqui -->

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