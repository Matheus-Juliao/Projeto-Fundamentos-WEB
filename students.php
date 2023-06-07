
<?php include 'C:\xampp\htdocs\FundamentosWeb\ProjetoWeb\Projeto-Fundamentos-WEB/students_inserts.php';

if (isset($_GET["success"]) && $_GET["success"] == 0) {
    if (isset($_GET["message"])) {
        $message = $_GET["message"];
        echo $message;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Simple Tables</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

        <!-- Students CSS -->
        <link rel="stylesheet" href="C:\xampp\htdocs\FundamentosWeb\ProjetoWeb\Projeto-Fundamentos-WEB/css/students.css">

        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">

        <link rel="stylesheet" href="css/students.css">
        
    </head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="home.php" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="images/logo-biofitness.png" alt="logo-biofitness-2" class="img-circle elevation-3"
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
        <div class="content-wrapper" style="margin-top: 20px;">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Alunos</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">

                                <form method="POST" action="students_inserts.php" class="formulario">
                                    <!-- Novo campo para o nome do aluno -->
                                    <input type="text" name="nome_aluno" placeholder="Nome do aluno">
                                    <input type="text" name="idade" placeholder="Idade">

                                    <select name="genero" class="genero-select">
                                        <option value="">Gênero</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="feminino">Feminino</option>
                                    </select>

                                    <input type="text" name="telefone" placeholder="Telefone">
                                    <input type="text" name="endereco" placeholder="Endereço">

                                    <!-- Botão para adicionar -->
                                    <button type="submit">Adicionar</button>
                                </form>


                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Editar</th>
                                                <th>Deletar</th>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Idade</th>
                                                <th>Genero</th>
                                                <th>Telefone</th>
                                                <th>Endereço</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td><a class='btn btn-primary' href='students_update.php?id=" . $row['id'] . "'><i class='bi bi-pencil-square'></i></a></td>";
                                                    echo "<td><a class='btn btn-danger' href='students_delete.php?id=" . $row['id'] . "'><i class='bi bi-trash'></i></a></td>";
                                                    echo "<td>" . $row['id'] . "</td>";
                                                    echo "<td>" . $row['nome_aluno'] . "</td>";
                                                    echo "<td>" . $row['idade'] . "</td>";
                                                    echo "<td>" . $row['genero'] . "</td>";
                                                    echo "<td>" . $row['telefone'] . "</td>";
                                                    echo "<td>" . $row['endereco'] . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
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
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
</body>

</html>