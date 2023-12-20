<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Tela Finalizar Pedido</title>
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
                                        <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("ProdutosAdicionados"); ?>">Produtos Adicionados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("MeusPedidosEnviados"); ?>">Pedidos</a>
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

    <div id="empresa" style="padding:20px;margin:1px;">
        <span style='color:blue;'><?= session("success"); ?></span>
        <span style='color:red;'><?= session("Error"); ?></span>
        <form class="register-form" action="<?= site_url("FinalizarPedidos/salvar") ?>" method="POST" enctype="multipart/form-data">
            <h2 class="display-4" style="font-size: 35px;"> Finalize seu Pedido!</h2>



            <fieldset>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="id_Usu"></label>
                        <input id="finalizar_pedido" class="form-control d-none" name="finalizar_pedido" value="Aberto">
                        <input id="func" type="hidden" class="form-control d-none" name="id_usuario" value=0>
                        <input id="pedido" type="hidden" class="form-control d-none" name="medida" value="">
                        <input id="nome_fun" type="hidden" class="form-control d-none" name="nome_fun" value="">
                        <input id="status" type="hidden" class="form-control d-none" name="status" value="Enviado">

                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-name-wrapper">
                            <label for="nome"><b>Nome*</b></label>
                            <input type="text" class="form-control" id="nome" name="nome_cliente" value="<?= $_SESSION['usuario']['nome'] ?>" placeholder="Nome">
                        </div>
                    </div>
                    <div class="col-6  col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="email"><b>Email*</b></label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['usuario']['email'] ?>" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-telnumber-wrapper">
                            <label for="tipoEntrega"><b>Tipo da Entrega*</b></label>
                            <select name="tipo_entrega" id="tipo_entrega" class="form-control mb-3" required>
                                <?php foreach ($tipoEntrega as $key => $tipo) :
                                    $selected = "";
                                    // if (v($arr, 'nivel') == $key) {
                                    $selected = "selected";
                                    // }
                                ?>
                                    <option <?= $selected ?> value="<?= $key ?>"><?= $tipo ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6" required>
                        <div id="lp-telnumber-wrapper">
                            <label for="forma_pg"><b>Forma de Pagamento*</b></label>
                            <select name="forma_pg" id="forma_pg" class="form-control mb-3" required>
                                <?php foreach ($formaPg as $key => $t) :
                                    $selected = "";
                                    // if (v($arr, 'nivel') == $key) {
                                    $selected = "selected";
                                    // }
                                ?>
                                    <option <?= $selected ?> value="<?= $key ?>"><?= $t ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="rua"><b>CEP*</b></label>
                            <input type="text" class="form-control cep-mask" id="cep" name="cep" placeholder="CEP" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="rua"><b>Rua*</b></label>
                            <input type="text" class="form-control" id="logradouro" name="rua" placeholder="Rua" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="numero"><b>Número*</b></label>
                            <input type="numeric" class="form-control" id="numero" name="num" placeholder="Número" required>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="bairro"><b>Bairro*</b></label>
                            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="cidade"><b>Cidade*</b></label>
                            <input type="text" class="form-control" id="cidade" name="municipio" placeholder="Cidade" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="uf"><b>UF*</b></label>
                            <input type="text" class="form-control" id="uf" name="uf" placeholder="UF" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12">
                        <div id="lp-lastname-wrapper">
                            <label for="referencia"><b>Referencia*</b></label>
                            <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Referencia" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12">
                        <label for=""></label>
                        <div id="lp-name-wrapper">
                            <button type="submit" id="botao_enviar_pedido" style="background-color: #B22222; border-color:#B22222;" class="btn btn-primary btn-block">Enviar Pedido</button>
                        </div>
                    </div>
                </div>
    </div>
    </fieldset>
    </form>
    <div class="col-12 col-sm-12 col-md-12">
       <center> <a style="color: black;" href='<?= site_url("cardapioCliente/index") ?>'>Continuar Comprando</a></center>
    </div>
    <!-- <div class="title-bullet"></div> -->
    <!-- <div class="title-bullet"></div> -->
    </br>
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