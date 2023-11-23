<?php

namespace App\Controllers;

class CardapioCliente extends BaseController
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
    public static function logado()
    {
        self::iniciarSessao();

        //se existir essa sessão o usuário está logado
        return isset($_SESSION['usuario']);
    }
   

    public function index($id = null)
    {
  
        $dados['id_categoria'] = -1;
    
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'http://api:5000/listar/categorias',
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        $categorias = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if(empty($categorias)){
            $categorias =[];

        }
    
        if ($id !== null) {
            $id_categoria = $id;
            $produtos = curl_init();
            curl_setopt_array($produtos, [
                CURLOPT_URL => 'http://api:5000/listar/categoria/produtos/'.$id_categoria,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false
            ]);
            $listagem = json_decode(curl_exec($produtos), true);
            curl_close($produtos);
            if(empty($listagem)){
                $listagem =[];

            }
           
            return view('telaCardapio_view', ['categorias' => $categorias, 'listagem' => $listagem, 'dados' => $dados]);
        }
        $listagem =[];
        return view('telaCardapio_view', ['categorias' => $categorias,'listagem' => $listagem ,'dados' => $dados]);
    }
    public function salvar()
    {
        $x = json_encode($_POST);
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'http://127.0.0.1:5000/inserir/pedido',
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $x,
            CURLOPT_SSL_VERIFYPEER => false


        ]);

        $resposta = curl_exec($ch);
        curl_close($ch);
        return redirect()->to(site_url('PedidosUsuarios/index/'));
    }
    
}
