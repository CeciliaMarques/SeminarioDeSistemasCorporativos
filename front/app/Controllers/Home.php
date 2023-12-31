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
      if (CardapioCliente::logado() === true) {

         return redirect()->to(site_url("CardapioCliente/index/"));
      } else {

         return redirect()->to(site_url("Home"));
      }
   }

   public function logar()
   {
      $x = json_encode($_POST);
      $ch = curl_init();
      curl_setopt_array($ch, [
         CURLOPT_URL => 'http://api:5000/login',
         CURLOPT_CUSTOMREQUEST => 'POST',
         CURLOPT_POSTFIELDS => $x,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_SSL_VERIFYPEER => false,

      ]);
      $arr = json_decode(curl_exec($ch), true);
      curl_close($ch);

      $dados['usuario'] = [];
      if (empty($arr) ) {
         return redirect()->to(site_url("home/login"));
      }
      if(!empty($arr[' message']) && $arr['message'] == 'Credenciais inválidos'){
         $this->session->setFlashdata('erro', 'Login ou senha incorreta.');
         return redirect()->to(site_url("home/login"));

      }
      if (!empty($arr) &&  isset($arr['dados'])){
         $dados['usuario'] = $arr['dados'][0];
         $token['token'] = $arr['token'];
      }
      if (isset($_POST) != null && !empty($dados['usuario'])) {

         $_SESSION["user"] = [];
         $_SESSION["user"]["id_usu"] = $dados['usuario']["id_usuario"];
         $_SESSION["user"]["nome"] = $dados['usuario']["nome"];
         $_SESSION["user"]["email"] = $dados['usuario']["email"];
         $_SESSION["user"]["nivel"] = $dados['usuario']["nivel"];
         $_SESSION["user"]["token"] = $token["token"];
         if ($_SESSION["user"]["nivel"] == NIVEL_ADMIN) {
            return redirect()->to(site_url("cadastroFunc"));
         }

         if ($_SESSION["user"]["nivel"] == NIVEL_FUNCIONARIO) {
            return redirect()->to(site_url("AtendimentoPedidosFuncionario"));
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
      unset($_SESSION['usuario']);
      return redirect()->to(site_url("home"));
   }
}
