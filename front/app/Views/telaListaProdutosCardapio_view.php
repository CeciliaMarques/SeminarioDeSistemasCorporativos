<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Tela pedido de bebidas </title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/fonts/font-awesome.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/Google-Style-Login.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/Navbar-with-menu-and-login.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/navbar.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/styles.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/title-bullets.css') ?>">
</head>

<body>
    <header class="" id="km-header">
        <nav class="navbar navbar-expand-lg p-0">
            <div class="km-navbar-brand text-lg-center">
                <div class="km-navbar-brand text-lg-center">
                    <div class="container">
                        <button aria-controls="navbarTogglerDemo03" style="background-color: #B22222;border: 1px solid black; color:white;" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarTogglerDemo03" data-toggle="collapse" type="button"><i aria-hidden="true" class="fa fa-bars"></i></button> <a class="navbar-brand" href="#">
                            <img alt="koolmj" class="img-fluid" src="<?= base_url('public/assets/img/logo_pizzaria.png') ?>" width="300px" height="300px"></a>
                        <div class="km-navbar-brand-btn-container">
                            <div class="km-navbar-brand-btn-container">
                                <?php if ($_SESSION["usuario"]["foto"] != "") : ?>
                                    <img class="rounded-circle" src="<?= $_SESSION['usuario']['foto'] ?>" width="60px" height="60px">
                                <?php endif; ?>
                                <?php if ($_SESSION["usuario"]['foto'] == "") : ?>
                                    <img class="rounded-circle img-thumbnail" src="<?= base_url("public/assets/img/avatarCor.png") ?>" width="60px" height="10px">
                                <?php endif; ?>
                                </br>
                                <label><b><a style="background-color:#B22222; border-color:black; color:white " href='<?= site_url("home/logout") ?>'>Sair</a></b></label>
                            </div>
                        </div>

                    </div>
                    <div class="km-navbar-menu" style="background-color:#B22222; ">
                        <div class="container">
                            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                                <ul class="navbar-nav m-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("CardapioCliente"); ?>">Lista de Categorias</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("bebidas"); ?>">Bebidas</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
        </nav>
    </header>

    <div id="empresa" style="padding:20px;margin:1px;">
        <span style='color:blue;'><?= session("success"); ?></span>
        <span style='color:red;'><?= session("Error"); ?></span>
        
        <div class="title-bullet"><span> </span></div>
  <div>
    <div class="container">
      <h2 class="display-4" style="font-size: 35px;">Lista de Produtos</h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th style="font-size: 20px;">Produto</th>
              <th style="font-size: 20px;">Unidade de Medida</th>
              <th style="font-size: 20px;">Valor</th>
              <th style="font-size: 20px;">Quantidade</th>
              <th style="font-size: 20px;">Fazer Pedido</th>
              
            </tr>
          </thead>
          <tbody>

            <?php foreach ($listagem as $item) : ?>
              <tr>
                <td style="line-height: 60px;font-size: 15px;"><?php print $item["nome"] ?></td>
                <td style="line-height: 60px;font-size: 15px;"><?php print $item["unidade_medida"] ?></td>
                <td style="line-height: 60px;font-size: 15px;"><?php print str_replace('.', ',', $item["valor"]) ?></td>
                <td></td>
                <td> <button class="btn btn-primary btn-block text-center d-block pull-right" type="button"   onclick="acrescentar();" style="height: 61px;background-color: #0b7442;">1</button></a></td>

                <td> <a href='<?= site_url("FinalizarPedidosPizza/index/{$item['id_produto']}") ?>'><button class="btn btn-primary btn-block
                   text-center d-block pull-right" type="button" style="height: 61px;background-color: #0b7442;">Comprar</button></a></td>

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