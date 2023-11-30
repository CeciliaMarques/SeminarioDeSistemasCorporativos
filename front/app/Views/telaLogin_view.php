<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tela de login</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/fonts/font-awesome.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/Google-Style-Login.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/Navbar-with-menu-and-login.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/navbar.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/styles.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('../public/assets/css/title-bullets.css') ?>">
</head>

<body>


    <div class="login-card">
        <span style='color:blue;'><?= session("success"); ?></span>
        <span style='color:red;'><?= session("erro"); ?></span>
        <img class="profile-img-card" src="<?= base_url('../public/assets/img/avatarCor.png') ?>">
        <p class="profile-name-card"> </p>
        <form class="form-signin" action="<?= site_url("home/logar") ?>" method="POST">
            <span class="reauth-email"> </span>
            <input class="form-control" name="email" type="email" id="email" required="" placeholder="Email" autofocus="">
            <input class="form-control" name="senha" type="password" id="senha" required="" placeholder="Senha">
            <button class="btn btn-primary btn-block btn-lg btn-signin" style="background-color: #B22222; border-color:#B22222;" type="submit">Entrar</button>

            <div class="form-group">
                <center>
                    <label id="l">
                        <a style="color:blue;" href='<?= site_url("home/cadastroUsuarioComum"); ?>'>
                            Cadastre-se</a></br>
                        <a style="color:blue;" href='<?= site_url("") ?>'>Recuperar senha</a>
                    </label></br>
                </center>
            </div>

        </form>
    </div>
    <script src='<?= base_url("public/assets/js/jquery.min.js") ?>'></script>
    <script src='<?= base_url("public/assets/bootstrap/js/bootstrap.min.js") ?>'></script>
</body>

</html>