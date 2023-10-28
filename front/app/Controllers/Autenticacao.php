<?php

namespace App\Controllers;

use Google\Client as  Google_Client;
use App\Controllers\PedidosUsuarios;

class Autenticacao extends BaseController
{
  /** 
   * Verifica se está logado 
   */
  public function index()
  {
    //Validação do $_COOKIE
    if (!isset($_POST['credential']) || !isset($_POST['g_csrf_token'])) {
      return redirect()->to(site_url("home"));

      exit;
    }

    $cookie = $_COOKIE['g_csrf_token'] ?? '';

    if ($_POST['g_csrf_token'] != $cookie) {
      return redirect()->to(site_url("home"));

      exit;
    }

    // Get $id_token via HTTPS POST.

    //Instacia do cliente google
    $client = new Google_Client(["client_id" =>"612629133152-qht0o8a463qd439han3906adpgnh9l9v.apps.googleusercontent.com"]);  // Specify the CLIENT_ID of the app that accesses the backend
    //Obtem os dados do usuário  com base no JWT
    $payload = $client->verifyIdToken($_POST["credential"]);
    //verifica os dados do payload
    if (isset($payload["email"])) {
      PedidosUsuarios::login($payload["name"], $payload["email"], $payload["picture"]);
      return redirect()->to(site_url("home/loginGoogleAtivo"));
      exit;
    } else {
      die("Houve um problema ao consultar a API do Google");
    }
  }
}
