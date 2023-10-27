<?php

namespace App\Controllers;

use App\Controllers\PedidosUsuarios;

class Home extends BaseController
{
   public function index()
   {  #chama a view 
      return view("telaPrincipal_view");
   }

   public function loginGoogleAtivo()
   {
      if (PedidosUsuarios::logado() === true) {

         return redirect()->to(site_url("PedidosUsuarios/index/"));
      } else {

         return redirect()->to(site_url("Home"));
      }
   }

   public function logar()
   {
      $x = json_encode($_POST);
      $ch = curl_init();
      curl_setopt_array($ch, [
         CURLOPT_URL => 'http://127.0.0.1:5000/login',
         CURLOPT_CUSTOMREQUEST => 'POST',
         CURLOPT_POSTFIELDS => $x,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_SSL_VERIFYPEER => false,

      ]);
      $arr = json_decode(curl_exec($ch), true);
      curl_close($ch);

      $dados['dados'] = [];
      if ($arr == []) {
         return redirect()->to(site_url("home/login"));
      }
      if (isset($arr) != [] && isset($arr) != null) {
         $dados['dados'] = $arr[0];
      }


      if (isset($_POST) != null && isset($dados['dados']) != []) {

         $_SESSION["user"] = [];
         $_SESSION["user"]["id_usu"] = $dados['dados']["id_usuariof"];
         $_SESSION["user"]["nome"] = $dados['dados']["nome"];
         $_SESSION["user"]["email"] = $dados['dados']["email"];
         $_SESSION["user"]["nivel"] = $dados['dados']["nivel"];

         if ($_SESSION["user"]["nivel"] == NIVEL_ADMIN) {
            return redirect()->to(site_url("cadastroFunc"));
         }

         if ($_SESSION["user"]["nivel"] == NIVEL_FUNCIONARIO) {
            return redirect()->to(site_url("AtendimentoPizzaFuncionario"));
         }

         if ($_SESSION["user"]["nivel"] == NIVEL_INACESSIVEL) {
            return redirect()->to(site_url("home"));
         } else {
            $this->session->setFlashdata('erro', 'Login ou senha incorreta.');
            return redirect()->to(site_url("home/login"));
         }
      } else {
         $this->session->setFlashdata('erro', 'Login ou senha incorreta.');
         return redirect()->to(site_url("home/login"));
      }
   }

   public function login()
   {
      return view("telaLogin_view");
   }

   public function CadastroUsuarioComum()
   {
      return view("telaAutoCadastro_view");
   }

   public function logout()
   {
      session_destroy();
      return redirect()->to(site_url("home"));
   }
}
