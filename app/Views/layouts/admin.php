<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 3</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') ?>">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/assets/admin/dist/css/adminlte.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/summernote/summernote-bs4.min.css') ?>">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/dropzone/min/dropzone.min.css') ?>">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= url_to('admin.usuario.perfil') ?>" class="nav-link">Perfil</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= url_to('admin.logout') ?>" class="nav-link">Sair</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Painel Adminstrativo</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('nome_usuario') ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= url_to('admin.index') ?>" class="nav-link <?= (current_url() == url_to('admin.index') || current_url() == url_to('admin.index')) ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if (session()->get('grupo') == 1 || session()->get('grupo') == 2) : ?>
                            <li class="nav-item <?= (current_url() == url_to('admin.vaga.listar') || current_url() == url_to('admin.vaga.add')) ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= (current_url() == url_to('admin.vaga.listar') || current_url() == url_to('admin.vaga.add')) ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-briefcase"></i>
                                    <p>
                                        Vagas
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= url_to('admin.vaga.listar') ?>" class="nav-link <?= (current_url() == url_to('admin.vaga.listar')) ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= url_to('admin.vaga.add') ?>" class="nav-link <?= (current_url() == url_to('admin.vaga.add')) ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cadastrar</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <?php endif; ?>
                        <?php if (session()->get('grupo') == 1 || session()->get('grupo') == 3) : ?>
                            <li class="nav-item <?= (current_url() == url_to('admin.imovel.listar') || current_url() == url_to('admin.imovel.add')) ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= (current_url() == url_to('admin.imovel.listar') || current_url() == url_to('admin.imovel.add')) ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-briefcase"></i>
                                    <p>
                                        Imóveis
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= url_to('admin.imovel.listar') ?>" class="nav-link <?= (current_url() == url_to('admin.imovel.listar')) ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= url_to('admin.imovel.add') ?>" class="nav-link <?= (current_url() == url_to('admin.imovel.add')) ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cadastrar</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <?php endif; ?>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= (isset($title)) ? $title : "Dashboard"; ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= url_to('admin.index') ?>">Home</a></li>
                                <li class="breadcrumb-item active"><?= (isset($title)) ? $title : "Dashboard"; ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url('/assets/admin/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('/assets/admin/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- ChartJS -->
    <script src="<?= base_url('/assets/admin/plugins/chart.js/Chart.min.js') ?>"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('/assets/admin/plugins/sparklines/sparkline.js') ?>"></script>
    <!-- JQVMap -->
    <script src="<?= base_url('/assets/admin/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
    <script src="<?= base_url('/assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url('/assets/admin/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('/assets/admin/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('/assets/admin/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('/assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
    <!-- Summernote -->
    <script src="<?= base_url('/assets/admin/plugins/summernote/summernote-bs4.min.js') ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('/assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('/assets/admin/dist/js/adminlte.js') ?>"></script>
    <!-- dropzonejs -->
    <script src="<?= base_url('/assets/admin/plugins/dropzone/min/dropzone.min.js') ?>"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>

    <script>
        var BASE_URL = '<?= base_url() ?>';
        $(document).ready(function() {
            // Aplicar máscara de CEP
            $('#cep').mask('00000-000');
            // Aplicar máscara de Salário
            $('#salario').mask('#.##0,00', {
                reverse: true
            });
            // Função para preencher endereço ao digitar o CEP
            function preencheEndereco(cep) {
                // Limpa o formulário de endereço
                $('#cidade').val("");
                $('#estado').val("");
                $('#localizacao').val("");

                // Consulta o webservice viacep.com.br
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/", function(dados) {
                    if (!("erro" in dados)) {
                        // Atualiza os campos com os valores da consulta.
                        $('#cidade').val(dados.localidade);
                        $('#estado').val(dados.uf);
                        $('#localizacao').val(dados.logradouro);
                    } else {
                        // CEP pesquisado não foi encontrado.
                        alert("CEP não encontrado.");
                    }
                });
            }

            // Quando o campo cep perde o foco.
            $('#cep').blur(function() {
                // Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                // Verifica se campo cep possui valor informado.
                if (cep !== "") {
                    // Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    // Valida o formato do CEP.
                    if (validacep.test(cep)) {
                        preencheEndereco(cep);
                    } else {
                        // cep é inválido.
                        alert("Formato de CEP inválido.");
                    }
                }
            });
        });
    </script>
    <?php
    if (isset($jsFiles)) :
        foreach ($jsFiles as $jsFile) {
            echo "<script src='{$jsFile}'></script>";
        }
    endif;
    ?>

</body>

</html>