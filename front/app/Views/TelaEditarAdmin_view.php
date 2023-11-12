<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Minha Conta</title>
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('/https://fonts.googleapis.com/css?family=Roboto:400,300,700,400italic,300italic,700italic') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/fonts/fontawesome-all.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/fonts/font-awesome.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/fonts/simple-line-icons.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/fonts/fontawesome5-overrides.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/Google-Style-Login.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/Navbar-with-menu-and-login.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/navbar.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/styles.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/title-bullets.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/TR-Form.css') ?>">
</head>

<body>
  <header class="" id="km-header">
    <nav class="navbar navbar-expand-lg p-0">
      <div class="km-navbar-brand text-lg-center">
        <div class="container">
          <button aria-controls="navbarTogglerDemo03" style="background-color: #B22222;border: 1px solid black; color:white;" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarTogglerDemo03" data-toggle="collapse" type="button"><i aria-hidden="true" class="fa fa-bars"></i></button> <a class="navbar-brand" href="#">
            <img alt="koolmj" class="img-fluid" src="<?= base_url('public/assets/img/logo_pizzaria.png') ?>" width="300px" height="300px"></a>
          <div class="km-navbar-brand-btn-container">
            <a class="km-navbar-brand-btn-container" style="background-color: #B22222; border: 1px solid black; color:white; font-size: 20px;" href='<?= site_url("home/logout") ?>'>Sair</a>
          </div>
        </div>
      </div>
      <div class="km-navbar-menu" style="background-color:#B22222; ">
        <div class="container">
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav m-auto">
              <li class="nav-item active">
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("cadastroFunc"); ?>">Funcionários</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("cadastroCategoria"); ?>">Categorias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("cadastroProduto"); ?>">Produtos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("contaUsuario"); ?>">Minha Conta</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("listagemPedidosFinalizadosAdmin"); ?>">Lista de Pedidos Finalizados</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <div id="empresa" style="padding:20px;margin:1px;">
    <span style='color:blue;'><?= session("success"); ?></span>
    <form class="register-form" action="<?= site_url("contaUsuario/update") ?>" method="POST" enctype="multipart/form-data">
      <h2 class="display-4" style="font-size: 35px;">Minha Conta</h2>
      <fieldset>
        <div class="form-row">
          <div class="form-group">
            <label for="id"></label>
            <input type="hidden" id="id_func" class="form-control" name="id_usuario" value="<?= $dados['id_usuario']; ?>">
            <input type="hidden" id="nivel" class="form-control" name="nivel" value="<?= $dados['nivel']; ?>">
          </div>
          <div class="col-6 col-sm-6 col-md-6">
            <div id="lp-mail-wrapper">
              <label for="formGroup1"><b>Nome*</b></label>
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= $dados['nome']; ?>" required>
            </div>
            <div style='color:blue;'></div>
          </div>
          <div class="col-6 col-sm-6 col-md-6">
            <div id="lp-name-wrapper">
              <label for="formGroup1"><b>Email*</b></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $dados['email']; ?>" required>
            </div>
            <div style='color:blue;'></div>
          </div>
          <div class="col-6 col-sm-6 col-md-6">
            <div id="lp-lastname-wrapper">
              <label for="formGroup1"><b>CPF*</b></label>
              <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" value="<?= $dados['cpf']; ?>" required>
            </div>
            <div style='color:blue;'></div>
          </div>
          <div class="col-6 col-sm-6 col-md-6">
            <div id="lp-lastname-wrapper">
              <label for="formGroup1"><b>Telefone*</b></label>
              <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000" value="<?= $dados['telefone']; ?>" required>
            </div>
            <div style='color:blue;'></div>
          </div>
          <div class="col-6 col-sm-6 col-md-6">
            <div id="lp-lastname-wrapper">
              <label for="formGroup1"><b>Senha*</b></label>
              <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <div style='color:blue;'></div>
          </div>
          <div class="col-6 col-sm-6 col-md-6">
            <div id="lp-lastname-wrapper">
              <label for="formGroup1"><b>Confirmar senha*</b></label>
              <input type="password" class="form-control" id="senhaConfirm" name="senhaConfirm" placeholder="Confirmar senha" required>
            </div>
            <div style='color:blue;'></div>
          </div>


          <div class="col-12 col-sm-12 col-md-12">
            <div id="lp-name-wrapper">
              <button type="submit" name="update" value="update" style="background-color: #B22222; border-color:#B22222;" class="btn btn-primary btn-block">Atualizar</button>
            </div>
          </div>



        </div>
      </fieldset>
    </form>
    <div class="title-bullet"></div>
    <div class="row p-0 m-0">
      <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center align-content-center p-0 m-0">
        <p class="p-0 m-0">Nos acompanhe através da nossas redes sociais:</p>
        <a class="p-0 m-2 d-inline-block" href="" target="_blank">
          <h3><i class="fa fa-facebook"></i></h3>
        </a>
        <a class="p-0 m-2 d-inline-block" href="" target="_blank">
          <h3><i class="fa fa-twitter"></i></h3>
        </a>
        <a class="p-0 m-2 d-inline-block" href="" target="_blank">
          <h3><i class="fa fa-youtube"></i></h3>
        </a>
      </div>
    </div>
  </div>
  </div>
  <script src="<?= base_url("public/js/jquery-3.6.0.min.js") ?>"></script>
  <script src="<?= base_url("public/js/jquery.mask.min.js") ?>"></script>
  <script src="<?= base_url("public/js/main.js") ?>"></script>
  <script src='<?= base_url("public/assets/js/jquery.min.js") ?>'></script>
  <script src='<?= base_url("public/assets/bootstrap/js/bootstrap.min.js") ?>'></script>
</body>

</html>