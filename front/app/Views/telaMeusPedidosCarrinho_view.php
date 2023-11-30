<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title> Tela Produtos Adicionados </title>
  <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/fonts/font-awesome.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('../public/bootstrap-icons/font/bootstrap-icons.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/fonts/bootstrap-icons.css') ?>">
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
        <div class="container">
          <button aria-controls="navbarTogglerDemo03" style="background-color: #B22222;border: 1px solid black; color:white;" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarTogglerDemo03" data-toggle="collapse" type="button"><i aria-hidden="true" class="fa fa-bars"></i></button> <a class="navbar-brand" href="#">
            <img alt="koolmj" class="img-fluid" src="<?= base_url('public/assets/img/logo_pizzaria.png') ?>" width="200px" height="300px"></a>
          <div class="km-navbar-brand-btn-container">
            <div class="km-navbar-brand-btn-container">
              <!--Colocar a foto do usuário, não se esqueça, por favor -->
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
                  <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("CardapioCliente"); ?>">Produtos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("ProdutosAdicionados"); ?>">Produtos Adiconados</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </nav>
  </header>
  <div id="empresa" style="padding:20px;margin:1px;">

    <div class="title-bullet"><span> </span></div>
    <div>
      <div class="container">
        <h2 class="display-4" style="font-size: 35px;">Lista de Produtos Adicionados</h2>
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="font-size: 20px;">Produto</th>
              <th style="font-size: 20px;">Tamanho</th>
              <th style="font-size: 20px;">Valor Unitário</th>
              <th style="font-size: 20px;">Valor</th>
              <th style="font-size: 20px;">Quantidade</th>
              <th class="text-center" style="font-size: 20px;">Remover</th>
            </tr>
            </thead>
            <form action="<?= site_url("produtosAdicionados/atualizarItens") ?>" method="POST">
              <? $totalPedido = 0; ?>
              <tbody>

                <?php if (empty($_SESSION['carrinho'])) {
                  $_SESSION['carrinho'] = [];
                  print("Carrinho Vazio!");
                }

                foreach ($_SESSION['carrinho'] as $id => $quant) :
                  $ch = curl_init();
                  curl_setopt_array($ch, [
                    CURLOPT_URL => 'http://api:5000/listar/produto/' . $id,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false

                  ]);
                  $itens = json_decode(curl_exec($ch), true);
                  curl_close($ch);

                ?>

                  <? foreach ($itens as $item) :
                    $subTotal = $item["valor"] * $quant;
                    $totalPedido += $subTotal; ?>

                    <tr>
                      <td style="line-height: 60px;font-size: 15px;"><?php print $item["nome"] ?></td>
                      <td style="line-height: 60px;font-size: 15px;"><?php print $item["unidade_medida"] ?></td>
                      <td style="line-height: 60px;font-size: 15px;"><?php print str_replace('.', ',', $item["valor"]) ?></td>
                      <td style="line-height: 60px;font-size: 15px;"><?php print $subTotal ?></td>
                      <td style="line-height: 60px;font-size: 15px;">
                        <input type="text" id="atualizar_carrinho" size="1px" class="text-center" name="prod[<?php echo $item['id_produto'] ?>]" value="<?php echo $quant ?>" size="1" />
                      </td>
                      <td style="line-height: 60px;font-size: 15px;"><a id="remover_produto_carrinho" href='<?= $url = site_url("ProdutosAdicionados/removerItens/{$item['id_produto']}") ?>'>
                          <i class="bi bi-cart-x" style="font-size: 35px; color:#B22222;"></i></a></td>
                      </td>
                      <?
                      if (!isset($_SESSION['dados'])) {
                        $_SESSION['dados'] = array();
                      }
                      $produto_existente = false;
                      foreach ($_SESSION['dados'] as &$produto) {
                        if ($produto['id_produto'] == $id) {
                          // Produto encontrado, atualiza a quantidade
                          $produto['nome'] = $item["nome"];
                          $produto['medida'] =  $item["unidade_medida"];
                          $produto['quant'] = $quant;
                          $produto['valor'] = $item["valor"];
                          $produto['total_pg'] = $subTotal;
                          $produto_existente = true;
                          break;
                        }
                      }
                      if (!$produto_existente) {
                        array_push(
                          $_SESSION['dados'],
                          array(
                            'id_produto' => $id,
                            'nome' => $item["nome"],
                            'medida' => $item["unidade_medida"],
                            'quant' => $quant,
                            'valor' =>  $item["valor"],
                            'total_pg' => $subTotal,
                          )
                        );
                      }
                      // unset($_SESSION['dados']);
                      // dd($_SESSION['dados']);
                      ?>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                    </tr>
                    <tr>
                      <td>Total: <?php print $totalPedido; ?>
                      <td>
                    </tr>
                    </tr>
              </tbody>
          </table>
          <button class="btn btn-primary" id="botao_atualizar_carrinho" type="submit" style="height: 45px; width: 150px; border: none;
           cursor: pointer;">Atualizar <i class="bi bi-cart"></i></button>

          </form>
          <a href='<?= site_url("FinalizarPedidos") ?>'>
            <button type="button" class="btn btn-primary" style="height: 45px; width: 150px;background-color: #0b7442; border: none;cursor: pointer;">
              Finalizar Pedido
            </button>
          </a>
        </div>
        <div>
          <a style="color: black;" href='<?= site_url("cardapioCliente/index") ?>'>Continuar Comprando</a>
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