<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Tela inicial </title>
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
                <div class="container">
                    <button aria-controls="navbarTogglerDemo03" style="background-color: #B22222;border: 1px solid black; color:white" aria-expanded=" false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#links_menu" data-toggle="collapse" type="button"><i aria-hidden="true" class="fa fa-bars"></i></button>
                    <a class="km-navbar-brand-btn-container" style="background-color: #B22222; border: 1px solid black; color:white; font-size: 20px;" href='<?= site_url("home/login") ?>'>LOGIN</a>
                </div>
            </div>
            </div>
            </div>
            <div class="container">
                </br>
                </br>
                </br>
            </div>
            </div>
            <div class="km-navbar-menu" style="background-color:#B22222 ; ">
                <div class="container">
                    <div class="collapse navbar-collapse" id="links_menu">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item active">
                                <a class="nav-link" Style="color: #white; font-size: 20px;" href="<?= site_url("home"); ?>">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
        </nav>
    </header>

    <!-- <div id="empresa" style="padding:20px;margin:1px;"> -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12" style="align-items: 'justify';">
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <img alt="koolmj" class="img-fluid" src="<?= site_url('../public/assets/img/logo.png') ?>"></a>

                        </div>
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <h2>Faça Já Seu Pedido!</h2>
                            </div>
                            <!-- <button type="submit" class="btn btn-primary btn-lg btn-block" style="font-size: 20px; background-color:#B22222; border: 1px solid black "> <i class="fa fa-google"><b>&nbsp AUTENTICAR</b></i></button> -->
                            <div class="row justify-content-md-center">
                                <div id="g_id_onload" data-client_id="309876707711-g5pguvj237avtedbqj1a5g4g1ucs6vmb.apps.googleusercontent.com" data-login_uri="<?= base_url("Autenticacao");?>" data-auto_prompt="false">
                                </div>
                                <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="rectangular" data-logo_alignment="left">
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    </br>
                    </br>
                </div>
            </div>
        </div>
        
    <footer style = "background-color:#B22222">
    <div class="row p-0 m-0">
      <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center align-content-center p-0 m-0">
        <p class="p-0 m-0" style ="color: white;">Nos acompanhe através da nossas redes sociais:</p>
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
  <!-- </div> -->
    </div>
    <script src='<?= base_url("public/assets/js/jquery.min.js") ?>'></script>
    <script src='<?= base_url("public/assets/bootstrap/js/bootstrap.min.js") ?>'></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</body>

</html>