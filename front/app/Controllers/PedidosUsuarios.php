<?php

namespace App\Controllers;

class PedidosUsuarios extends BaseController
{
    /**
     * 
     * @return boolean
     */

    private static function iniciarSessao()
    {
        return  session_status() !== PHP_SESSION_ACTIVE ? session_start() : true;
    }

      /**
     * 
     * @param string $nome
     * @param string $email
     * @param string $foto
     */

    public static function login($nome, $email, $foto)
    {
         //Inicia a sessão da aplicação
        self::iniciarSessao();
        //Define a sessão do usuário
        $_SESSION['usuario'] = [
            'nome' => $nome,
            'email' => $email,
            'foto' => $foto


        ];
    }
/**
 * Verifica se o usuário está logado
 *  @return  boolean
*/
    public static function logado(){
        self::iniciarSessao();

        //se existir essa sessão o usuário está logado
        return isset( $_SESSION['usuario']);


    }


    public function index()
    {  
        // $usuarioModel = new \App\Models\UsuarioModel();
        // $arr['tipoEntrega'] = $usuarioModel->tipoEntrega;
        // $arr['tamanhoPizza'] = $usuarioModel->tamanhoPizza;
        // $arr['volume'] = $usuarioModel->volume;
        // $arr['formaPg'] = $usuarioModel->formaPg;
        // $arr['tipo'] = $usuarioModel->tipo;



        // if ($_GET == null) {
        //     $arr['dados']['id_usuariof'] = -1;
        //     $arr['dados']['nome'] = '';
        //     $arr['dados']['id_pizza'] = -1;
        //     $arr['dados']['tamanho'] = '';
        //     $arr['dados']['id_bebida'] = '';
        //     $arr['dados']['tipoBebida'] = 0;
        //     $arr['dados']['medida'] = '';
        //   }
        //   if ($id != null &&  $id>-1) {
        //     $idU = $id;
        //     $ch = curl_init();
        //     curl_setopt_array($ch, [
        //       CURLOPT_URL => 'http://localhost:5000/usuario/' . $idU,
        //       CURLOPT_CUSTOMREQUEST => 'GET',
        //       CURLOPT_RETURNTRANSFER => true,
        //       CURLOPT_SSL_VERIFYPEER => false
      
        //     ]);
        //     $arr = json_decode(curl_exec($ch), true);
        //     curl_close($ch);
      
        //     $arr['dados'] = $arr[0];
        //   }

        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://127.0.0.1:5000/pizzas',
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false
    
        ]);
        $arr['pizzas'] = json_decode(curl_exec($ch), true);
        curl_close($ch);

        // $ch = curl_init();
        // curl_setopt_array($ch, [
        //   CURLOPT_URL => 'http://localhost:5000/bebidas',
        //   CURLOPT_CUSTOMREQUEST => 'GET',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_SSL_VERIFYPEER => false
    
        // ]);
        // $arr['bebidas'] = json_decode(curl_exec($ch), true);
        // curl_close($ch);

        return view('telaCardapioPizza_view', $arr);
        // return view('telaCardapioPizza_view');
      
    }
    public function salvar()
    {
        $x = json_encode($_POST);
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://127.0.0.1:5000/inserir/pedido',
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POSTFIELDS =>$x,
          CURLOPT_SSL_VERIFYPEER => false
    
    
        ]);
    
        $resposta = curl_exec($ch);
        curl_close($ch);
        return redirect()->to(site_url('PedidosUsuarios/index/'));
    }

 
}
