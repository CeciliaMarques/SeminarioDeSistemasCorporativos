<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Tela de Cardapio </title>
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('/https://fonts.googleapis.com/css?family=Roboto:400,300,700,400italic,300italic,700italic') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/fonts/fontawesome-all.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/fonts/font-awesome.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('../public/bootstrap-icons/font/bootstrap-icons.min.css') ?>">
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
            <img alt="koolmj" class="img-fluid" src="<?= base_url('public/assets/img/logo_pizzaria.png') ?>" width="200px" height="300px"></a>
          <div class="km-navbar-brand-btn-container">

            <?php if ($_SESSION["usuario"]["foto"] != "") : ?>
              <img class="rounded-circle" src="<?= $_SESSION['usuario']['foto'] ?>" width="60px" height="60px">
            <?php endif; ?>
            <?php if ($_SESSION["usuario"]['foto'] == "") : ?>
              <img class="rounded-circle img-thumbnail" src="<?= base_url("public/assets/img/avatarCor.png") ?>" width="60px" height="10px">
            <?php endif; ?>
            </br>
          </div>
        </div>
        <div class="km-navbar-menu" style="background-color:#B22222; ">
          <div class="container">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
              <ul class="navbar-nav m-auto">
                <li class="nav-item">
                  <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("CardapioCliente"); ?>">Produtos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("ProdutosAdicionados"); ?>">Produtos Adiconados</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("MeusPedidosEnviados"); ?>">Meus Pedidos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" Style="color: #white; font-size: 20px;" href='<?= site_url("home/logout") ?>'>Sair</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </nav>
  </header>

  <div class="title-bullet"></div>
  <div>
    <div class="container">
      <h2 class="display-4" style="font-size: 35px;">Categorias</h2>
      <select name="id_categoria" class="form-control mb-3" onchange="redirecionarCategoria(this)">
        <option value="" <?php echo empty($dados["id_categoria"]) ? "selected" : ""; ?>>Escolha uma categoria</option>
        <?php foreach ($categorias as $categoria) :
          $selected = "";
          if ($dados["id_categoria"] == $categoria["id_categoria"]) {
            $selected = "selected";
          }
        ?>
          <option value="<?= site_url("CardapioCliente/index/{$categoria['id_categoria']}") ?>" <?= $selected ?>>
            <?= $categoria["nome"] ?>

          </option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>


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
              <th style="font-size: 20px;">Adicionar</th>

            </tr>
          </thead>
          <tbody>

            <?php foreach ($listagem as $item) : ?>
              <tr>
                <td style="line-height: 60px;font-size: 15px;"><?php print $item["nome"] ?></td>
                <td style="line-height: 60px;font-size: 15px;"><?php print $item["unidade_medida"] ?></td>
                <td style="line-height: 60px;font-size: 15px;"><?php print "R$ ".str_replace('.', ',', $item["valor"]) ?></td>
                <td> <a id="adicionar_carrinho" href='<?= site_url("ProdutosAdicionados/adicionarItens/{$item['id_produto']}") ?>'><i class="bi bi-cart-plus" style="font-size: 35px; color: #0b7442;"></i></button></a></td>

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