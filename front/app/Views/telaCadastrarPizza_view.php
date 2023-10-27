<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Cadastro de Pizza</title>
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
          <button aria-controls="navbarTogglerDemo03" style="background-color: #B22222;border: 1px solid black; color:white;" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarTogglerDemo03" data-toggle="collapse" type="button"><i aria-hidden="true" class="fa fa-bars"></i></button> <a class="navbar-brand" href="">
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
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("cadastroPizza"); ?>">Pizzas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("cadastrarBebida"); ?>">Bebidas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("contaUsuario"); ?>">Minha Conta</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("listagemPedidosFinalizadosAdminPizza"); ?>">Pedidos de Pizzas Finalizados</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("listagemPedidosFinalizadosAdminBebida"); ?>">Pedidos de Bebidas Finalizados</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <div id="empresa" style="padding:20px;margin:1px;">
    <span style='color:blue;'><?= session("success"); ?></span>
    <form class="register-form" action="<?= site_url("cadastroPizza/getPost") ?>" method="POST" enctype="multipart/form-data">
      <h2 class="display-4" style="font-size: 35px;">Cadastro de Pizza</h2>
      <fieldset>
        <div class="form-row">
          <div class="form-group">
            <label for="id"></label>
            <input type="hidden" id="id_func" class="form-control" name="id_usuariof">
            <input type="hidden" id="id_pizza" class="form-control" name="id_pizza" value="<?= $dados['id_pizza']; ?>">
          </div>
          <div class="col-12 col-sm-12 col-md-12">
            <div id="lp-mail-wrapper">
              <label for="formGroup1"><b>Sabor*</b></label>
              <input type="text" class="form-control" id="sabor" name="sabor_pizza" placeholder="Sabor" value="<?= $dados['sabor_pizza']; ?>" required>
            </div>
            <div style='color:blue;'></div>
          </div>
          <div class="col-12 col-sm-12 col-md-12" required>
            <div id="lp-telnumber-wrapper">
              <label for="tamanho"><b>Tamanho*</b></label>
              <select name="tamanho" class="form-control mb-3">
                <?php foreach ($tamanhoPizza as $key => $pizza) :
                  $selected = "";
                  if ($dados['tamanho'] == $key) {
                    $selected = "selected";
                  }
                ?>
                  <option <?= $selected ?> value="<?= $key ?>"><?= $pizza ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div style='color:blue;'></div>
          </div>
          <div class="col-12 col-sm-12 col-md-12">
            <div id="lp-lastname-wrapper">
              <label for="formGroup1"><b>Preço*</b></label>
              <input type="number" class="form-control" id="preco" step="0.01" name="valor" placeholder="30,00" value="<?= $dados['valor']; ?>" required>
            </div>
            <div style='color:blue;'></div>
          </div>
          <div class="col-4 col-sm-4 col-md-4">
            <div id="lp-name-wrapper">
              <button type="submit" name="salvar" value="salvar" style="background-color: #B22222; border-color:#B22222;" class="btn btn-primary btn-block">Salvar</button>
            </div>
          </div>
          <div class="col-4 col-sm-4 col-md-4">
            <div id="lp-name-wrapper">
              <button type="submit" name="update" value="update" style="background-color: #B22222; border-color:#B22222;" class="btn btn-primary btn-block">Atualizar</button>
            </div>
          </div>

          <div class="col-4 col-sm-4 col-md-4">
            <div id="lp-name-wrapper">
              <button type="submit" name="limpar" value="limpar" style="background-color: #B22222; border-color:#B22222;" class="btn btn-primary btn-block">Limpar</button>
            </div>
          </div>


        </div>
      </fieldset>
    </form>

    <div class="title-bullet"><span> </span></div>
    <div>
      <div class="container">
        <h2 class="display-4" style="font-size: 35px;">Lista de Pizzas</h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="font-size: 20px;">Sabor</th>
                <th style="font-size: 20px;">Tamanho</th>
                <th style="font-size: 20px;">valor</th>
                <th class="text-center" style="font-size: 20px;">Editar</th>
                <th class="text-center" style="font-size: 20px;">Excluir</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($listagem as $item) : ?>
                <tr>
                  <td style="line-height: 60px;font-size: 15px;"><?php print $item["sabor_pizza"] ?></td>
                  <td style="line-height: 60px;font-size: 15px;"><?php print $item["tamanho"] ?></td>
                  <td style="line-height: 60px;font-size: 15px;"><?php print str_replace('.', ',', $item["valor"]) ?></td>
                  <td> <a href='<?= site_url("cadastroPizza/index/{$item['id_pizza']}") ?>'><button class="btn btn-primary btn-block text-center d-block pull-right" type="button" style="height: 61px;background-color: #0b7442;"><i class="far fa-edit" style="font-size: 36px;"></i></button></a></td>
                  <td> <a href='<?= $url = site_url("cadastroPizza/deletar/{$item['id_pizza']}") ?>'>
                      <button href='#' onclick='confirmDelete("<?= $url ?>")' class="btn btn-primary btn-block text-center d-block pull-right" type="button" style="height: 61px;background-color: #B22222;"><i class="far fa-trash-alt" style="font-size: 36px;"></i></button> </a>
                  <?php endforeach; ?>
                  </td>
                </tr>
                <tr>
                </tr>
            </tbody>
          </table>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12" style="background-color:#20B2AA"></div>
      </div>
    </div>

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