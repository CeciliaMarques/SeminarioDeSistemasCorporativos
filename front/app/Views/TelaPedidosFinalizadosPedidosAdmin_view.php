<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Tela pedidos de pizzas Finalizados </title>
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
                                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("cadastroPizza"); ?>">Pizzas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("cadastrarBebida"); ?>">Bebidas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("contaUsuario"); ?>">Minha Conta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("ControlePedidoAdmin"); ?>">Pedidos de Pizzas Finalizados</a>
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
                <h2 class="display-4" style="font-size: 35px;">Lista de Pedidos de Pizzas Finalizados</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="font-size: 20px;"> Cliente</th>
                                <th style="font-size: 20px;">Email</th>
                                <th style="font-size: 20px;">Sabor da Pizza</th>
                                <th style="font-size: 20px;">Tamanho</th>
                                <th style="font-size: 20px;">Tipo da Entrega</th>
                                <th style="font-size: 20px;">Forma de Pagamento</th>
                                <th style="font-size: 20px;">Total</th>
                                <th style="font-size: 20px;">CEP</th>
                                <th style="font-size: 20px;">Cidade</th>
                                <th style="font-size: 20px;">Bairro</th>
                                <th style="font-size: 20px;">UF</th>
                                <th style="font-size: 20px;">Número</th>
                                <th style="font-size: 20px;"> Status do Pedido</th>
                                <th style="font-size: 20px;"> Funcionário</th>
                                <th class="text-center" style="font-size: 20px;">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($listagem as $item) : ?>
                                <?php $totalPedido += $item['valor']; ?>
                                <tr>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["nome_cliente"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["email"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["sabor_pizza"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["tamanho"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["tipo_entrega"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["forma_pg"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print "R$ " . str_replace('.', ';', $item["total_pg"]) ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["cep"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["municipio"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["bairro"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["uf"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["num"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["finalizar_pedido"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["nome_func"] ?></td>
                                    <td> <a href='<?= $url = site_url("ControlePedidoAdmin/deletar/{$item['id_pedido']}") ?>'>
                                            <button href='#' onclick='confirmDelete("<?= $url ?>")' class="btn btn-primary btn-block text-center d-block pull-right" type="button" style="height: 61px;background-color: #B22222;"><i class="far fa-trash-alt" style="font-size: 36px;"></i></button> </a>
                                    <?php endforeach; ?>
                                    </td>
                                </tr>

                        </tbody>

                    </table>
                    <label>Total: <?php print "R$ " . $totalPedido; ?>
                            </label>
                </div>
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