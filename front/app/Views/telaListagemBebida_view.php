<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Tela pedido de Bebidas </title>
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
                            <li class="nav-item">
                                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("AtendimentoPizzaFuncionario"); ?>">Pedidos de Pizzas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("AtendimentoBebidaFuncionario"); ?>">Pedidos de Bebidas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("contaUsuarioFuncionario"); ?>">Minha Conta</a>
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
        <form class="register-form" action="<?= site_url("AtendimentoBebidaFuncionario/getPost") ?>" method="POST" enctype="multipart/form-data">
            <h2 class="display-4" style="font-size: 35px;">Pedidos de Bebidas</h2>
            <fieldset>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="id_Usu"></label>

                        <input id="func" class="form-control d-none" name="id_usuariof" value="<?= $_SESSION["user"]["id_usu"] ?>">
                        <input id="func" class="form-control d-none" name="nome_func" value="<?= $_SESSION["user"]["nome"] ?>">
                        <input id="pedido" class="form-control d-none" name="id_pedido" value="<?= $dados['id_pedido']; ?>">
                        <input id="id_pizza" class="form-control d-none" name="id_bebida" value="<?= $dados['id_bebida'] ?>">
                        <input type="hidden" class="form-control" id="total_pg" step="0.01" name="total_pg" placeholder="Total" value="<?= $dados['total_pg'] ?>" required>

                    </div>
                    <div class="col-12 col-sm-12 col-md-12">
                        <div id="lp-name-wrapper">
                            <label for="nome"><b>Nome*</b></label>
                            <input type="text" class="form-control" id="nome" name="nome_cliente" placeholder="Nome" value="<?= $dados['nome_cliente'] ?>">
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="email"><b>Email*</b></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $dados['email'] ?>">
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="tamanho"><b>Medida*</b></label>
                            <input type="text" class="form-control" id="sabor_pizza" name="medida" placeholder="Medida" value="<?= $dados['medida'] ?>">
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-telnumber-wrapper">
                            <label for="sabor"><b>Sabor da Bebida*</b></label>
                            <input type="text" class="form-control" id="sabor_bebida" name="sabor_bebida" placeholder="sabor" value="<?= $dados['sabor_bebida'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="tamanho"><b>Tipo*</b></label>
                            <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo" value="<?= $dados['tipo'] ?>">
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-telnumber-wrapper">
                            <label for="tamanho"><b>Tipo Entrega*</b></label>
                            <input type="text" class="form-control" id="tipo_entrega" name="tipo_entrega" placeholder="Tipo da entrega" value="<?= $dados['tipo_entrega'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-telnumber-wrapper">
                            <label for="forma_pg"><b>Forma de Pagamento*</b></label>
                            <input type="text" class="form-control" id="forma_pg" name="forma_pg" placeholder="Forma de pagamento" value="<?= $dados['forma_pg'] ?>" requered>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="rua"><b>Rua*</b></label>
                            <input type="text" class="form-control" id="logradouro" name="rua" placeholder="Rua" value="<?= $dados['rua'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="numero"><b>Número*</b></label>
                            <input type="numeric" class="form-control" id="numero" name="num" placeholder="Número" value="<?= $dados['num'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="rua"><b>CEP*</b></label>
                            <input type="text" class="form-control cep-mask" id="cep" name="cep" placeholder="CEP" value="<?= $dados['cep'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="bairro"><b>Bairro*</b></label>
                            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?= $dados['bairro'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="cidade"><b>Cidade*</b></label>
                            <input type="text" class="form-control" id="cidade" name="municipio" placeholder="Cidade" value="<?= $dados['municipio'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="uf"><b>UF*</b></label>
                            <input type="text" class="form-control" id="uf" name="uf" placeholder="UF" value="<?= $dados['uf'] ?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12">
                        <div id="lp-lastname-wrapper">
                            <label for="potavel" style=""><b>Finalizar Pedido?*</b></label>
                            <label><input type="radio" name="finalizar_pedido" value="Pendente" <?php $dados['finalizar_pedido'] == "Pendente" ? print 'checked' : '' ?>>Não</label>
                            <label><input type="radio" name="finalizar_pedido" value="Finalizado" <?php $dados['finalizar_pedido'] == "Finalizado" ? print 'checked' : '' ?>>Sim</label>
                        </div>
                        </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div id="lp-lastname-wrapper">
                            <label for="senhaConfirm"><b>Total : R$<?=str_replace('.', ',',$dados['total_pg']) ?> </b></label>
                        </div>
                    </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <label for=""></label>
                            <div id="lp-name-wrapper">
                                <button type="submit" name="update" style="background-color: #B22222; border-color:#B22222;" class="btn btn-primary btn-block">Salvar</button>
                            </div>
                       
                    </div>
            </fieldset>
        </form>
        <div class="title-bullet"><span> </span></div>
        <div>
            <div class="container">
                <h2 class="display-4" style="font-size: 35px;">Lista de Pedidos</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="font-size: 20px;"> Cliente</th>
                                <th style="font-size: 20px;">Email</th>
                                <th style="font-size: 20px;">Sabor da Bebida</th>
                                <th style="font-size: 20px;">Medida</th>
                                <th style="font-size: 20px;">Tipo da Entrega</th>
                                <th style="font-size: 20px;">Forma de Pagamento</th>
                                <th style="font-size: 20px;">Total</th>
                                <th style="font-size: 20px;">CEP</th>
                                <th style="font-size: 20px;">Cidade</th>
                                <th style="font-size: 20px;">Bairro</th>
                                <th style="font-size: 20px;">UF</th>
                                <th style="font-size: 20px;">Número</th>
                                <th style="font-size: 20px;"> Status do Pedido</th>
                                <th class="text-center" style="font-size: 20px;">Editar</th>
                                <th class="text-center" style="font-size: 20px;">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($listagem as $item) : ?>
                                <tr>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["nome_cliente"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["email"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["sabor_bebida"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["medida"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["tipo_entrega"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["forma_pg"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print str_replace('.', ',', $item["total_pg"]) ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["cep"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["municipio"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["bairro"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["uf"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["num"] ?></td>
                                    <td style="line-height: 60px;font-size: 15px;"><?php print $item["finalizar_pedido"] ?></td>
                                    <td> <a href='<?= site_url("atendimentoBebidaFuncionario/index/{$item['id_pedido']}") ?>'><button class="btn btn-primary btn-block text-center d-block pull-right" type="button" style="height: 61px;background-color: #0b7442;"><i class="far fa-edit" style="font-size: 36px;"></i></button></a></td>
                                    <td> <a href='<?= $url = site_url("atendimentoBebidaFuncionario/deletar/{$item['id_pedido']}") ?>'>
                                            <button href='#' onclick='confirmDelete("<?= $url ?>")' class="btn btn-primary btn-block text-center d-block pull-right" type="button" style="height: 61px;background-color: #B22222;"><i class="far fa-trash-alt" style="font-size: 36px;"></i></button> </a>
                                    <?php endforeach; ?>
                                    </td>
                                </tr>

                        </tbody>

                    </table>
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