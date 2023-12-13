<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
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
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/bootstrap-icons/font/bootstrap-icons.min.css') ?>">
</head>

<body>
    <header class="" id="km-header">
        <nav class="navbar navbar-expand-lg p-0">
            <div class="km-navbar-brand text-lg-center">
                <div class="container">
                    <button aria-controls="navbarTogglerDemo03" style="background-color: #B22222;border: 1px solid black; color:white;" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarTogglerDemo03" data-toggle="collapse" type="button"><i aria-hidden="true" class="fa fa-bars"></i></button> <a class="navbar-brand" href="#">
                        <img alt="koolmj" class="img-fluid" src="<?= base_url('public/assets/img/logo_pizzaria.png') ?>" width="200px" height="200px"></a>
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
                                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("AtendimentoPedidosFuncionario"); ?>">Pedidos de Produtos</a>
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
        <form class="register-form" action="<?= site_url("AtendimentoPedidosFuncionario/update") ?>" method="POST" enctype="multipart/form-data">
            <h2 class="display-4" style="font-size: 35px;">Pedidos de Produtos</h2>
            <fieldset>
                <div class="form-row">
                    <div class="col-md-12">

                        <input id="func" class="form-control d-none" name="id_usuario" value="<?= $_SESSION["user"]["id_usu"]; ?>">
                        <input id="func" class="form-control d-none" name="nome_fun" value="<?= $_SESSION["user"]["nome"]; ?>">
                        <input id="pedido" class="form-control d-none" name="id_pedido" value="<?= $dados['id_pedido']; ?>">
                        <input id="id_pizza" class="form-control d-none" name="id_produto" value="<?= $dados['id_produto']; ?>">
                        <input type="hidden" class="form-control" id="total_pg" name="total_pg" value="<?= $dados['total_pg']; ?>">
                        <input type="hidden" class="form-control" id="nome" name="nome_cliente" value="<?= $dados['nome_cliente'] ?>">
                        <input type="hidden" class="form-control" id="email" name="email" value="<?= $dados['email'] ?>">
                        <input type="hidden" class="form-control" id="produto" name="produto" value="<?= $dados['produto'] ?>">
                        <input type="hidden" class="form-control" id="medida" name="medida" value="<?= $dados['medida'] ?>">
                        <input type="hidden" class="form-control" id="quant" name="quant" value="<?= $dados['quant'] ?>">
                        <input type="hidden" class="form-control" id="cep" name="cep" value="<?= $dados['cep'] ?>">
                        <input type="hidden" class="form-control" id="rua" name="rua" value="<?= $dados['rua'] ?>">
                        <input type="hidden" class="form-control" id="num" name="num" value="<?= $dados['num'] ?>">
                        <input type="hidden" class="form-control" id="bairro" name="bairro" value="<?= $dados['bairro'] ?>">
                        <input type="hidden" class="form-control" id="municipio" name="municipio" value="<?= $dados['municipio'] ?>">
                        <input type="hidden" class="form-control" id="uf" name="uf" value="<?= $dados['uf'] ?>">
                        <input type="hidden" class="form-control" id="referencia" name="referencia" value="<?= $dados['referencia'] ?>">
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12" required>
                    <div id="lp-telnumber-wrapper">
                        <label for="forma_pg"><b>Forma de Pagamento*</b></label>
                        <select name="forma_pg" class="form-control mb-3" required>
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
                <div class="col-12 col-sm-12 col-md-12">
                    <div id="lp-telnumber-wrapper">
                        <label for="tipoEntrega"><b>Status*</b></label>
                        <select name="status" class="form-control mb-3" required>
                            <?php foreach ($status as $key => $tipo) :
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
                <div class="col-12 col-sm-12 col-md-12">
                    <div id="lp-telnumber-wrapper">
                        <label for="tipoEntrega"><b>Tipo da Entrega*</b></label>
                        <select name="tipo_entrega" class="form-control mb-3" required>
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
                <div class="col-12 col-sm-12 col-md-12">
                    <div id="lp-lastname-wrapper">
                        <label for="total_pg"><b>Total : R$<?= $dados['total_pg'] ?> </b></label>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12">
                    <div id="lp-lastname-wrapper">
                        <label for="potavel"><b>Finalizar Pedido?*</b></label>
                        <label><input type="radio" name="finalizar_pedido" value="Em Andamento" <?php $dados['finalizar_pedido'] == "Pendente" ? print 'checked' : '' ?>>Não</label>
                        <label><input type="radio" name="finalizar_pedido" value="Finalizado" <?php $dados['finalizar_pedido'] == "Finalizado" ? print 'checked' : '' ?>>Sim</label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12">
                        <label for=""></label>
                        <div id="lp-name-wrapper">
                            <button type="submit" style="background-color: #B22222; border-color:#B22222;" class="btn btn-primary btn-block">Salvar</button>
                        </div>
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
                                <th style="font-size: 20px;">ID</th>
                                <th style="font-size: 20px;"> Cliente</th>
                                <th style="font-size: 20px;">Email</th>
                                <th style="font-size: 20px;">Tipo Entrega</th>
                                <th style="font-size: 20px;">Forma de Pagamento</th>
                                <th style="font-size: 20px;">Endereço</th>
                                <th style="font-size: 20px;">Status do Pedido</th>
                                <th style="font-size: 20px;">Produto</th>
                                <th style="font-size: 20px;">Medida</th>
                                <th style="font-size: 20px;">Finalizar Pedido</th>
                                <th style="font-size: 20px;">Total</th>
                                <th style="font-size: 20px;">Data do Pedido</th>
                                <th style="font-size: 20px;">Horario</th>
                                <th class="text-center" style="font-size: 20px;">Editar</th>
                                <th class="text-center" style="font-size: 20px;">Excluir</th>
                                <th class="text-center" style="font-size: 20px;">Notificar</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($listagem as $item) : ?>
                                <tr>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $item["id_pedido"] ?></td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $item["nome_cliente"] ?></td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $item["email"] ?></td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $item["tipo_entrega"] ?></td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $item["forma_pg"] ?></td>
                                    <td style="line-height: 40px;font-size: 15px;">

                                        <?php print $item["cep"] . "," ?>
                                        <?php print $item["rua"] . "," ?>
                                        <?php print $item["num"] . "," ?>
                                        <?php print $item["bairro"] . "," ?>
                                        <?php print $item["municipio"] . "," ?>
                                        <?php print $item["uf"] . "," ?>
                                        <?php print $item["referencia"] . "" ?>
                                    </td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $item["status"] ?></td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $item["produto"] ?></td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $item["medida"] ?></td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $item["finalizar_pedido"] ?></td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print str_replace('.', ',', $item["total_pg"]) ?></td>
                                    <?php $data = date('d-m-y', strtotime($item["data"]));
                                    $horaAtual = date("H:i:s", strtotime($item["hora"])); ?>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $data ?></td>
                                    <td style="line-height: 40px;font-size: 15px;"><?php print $horaAtual ?></td>
                                    <td> <a href='<?= site_url("atendimentoPedidosFuncionario/index/{$item['id_pedido']}") ?>'><button class="btn btn-primary btn-block text-center d-block pull-right" type="button" style="height: 61px;background-color: #0b7442 ;width: 60px;"><i class="far fa-edit" style="font-size: 36px;"></i></button></a></td>
                                    <td> <a href='<?= $url = site_url("atendimentoPedidosFuncionario/deletar/{$item['id_pedido']}") ?>'>
                                            <button href='#' onclick='confirmDelete("<?= $url ?>")' class="btn btn-primary btn-block text-center d-block pull-right" type="button" style="height: 61px;background-color: #B22222; width: 60px;"><i class="far fa-trash-alt" style="font-size: 36px;"></i></button> </a>
                                    </td>
                                    <td> <a href='<?= site_url("atendimentoPedidosFuncionario/notificar/{$item['id_pedido']}") ?>'><button class="btn btn-primary btn-block text-center d-block pull-right" type="button" style="height: 61px; background-color:#0d6efd; color:#FFFFFF; width: 60px;"><i class="bi bi-envelope-at" style="font-size: 36px;"></i></button></a></td>
                                        <?php endforeach; ?>
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