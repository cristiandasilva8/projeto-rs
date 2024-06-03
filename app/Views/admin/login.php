<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('/assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/assets/admin/dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?= base_url('admin/login'); ?>"><b>Painel</b> Adminstrativo</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Faça seu login</p>

        <form action="<?= url_to('admin.check.login'); ?>" method="POST">
          <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger">
              <?= session('error'); ?>
            </div>
          <?php endif; ?>

          <?php if (session()->has('success')) : ?>
            <div class="alert alert-success">
              <?= session('success'); ?>
            </div>
          <?php endif; ?>
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="E-mail">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="senha" class="form-control" placeholder="Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Acessar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="<?= url_to('admin.recupera.senha') ?>">Recuperar senha</a>
        </p>
        <p class="mb-0">
          <a href="<?= base_url('admin/registrar') ?>" class="text-center">Criar uma conta</a>
        </p>
        <p class="mb-0">
          <a href="<?= base_url('vagas/procurar-vagas')  ?>" class="text-center">Voltar para a página de vagas</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('/assets/admin/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('/assets/admin/dist/js/adminlte.min.js') ?>"></script>
</body>

</html>