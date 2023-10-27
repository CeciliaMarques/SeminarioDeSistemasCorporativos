<?php

namespace App\Controllers;

class AtendimentoPizzaFuncionario extends BaseController
{


  /** 
   * Consumindo método get de api em Python
   */

  public function index($id = null)
  {


    $usuarioModel = new \App\Models\UsuarioModel();
    if ($_GET == null) {
      $arr['dados']['id_pedido'] = -1;
      $arr['dados']['nome_cliente'] = '';
      $arr['dados']['email'] = '';
      $arr['dados']['id_pizza'] = -1;
      $arr['dados']['id_usuariof'] = -1;
      $arr['dados']['tamanho'] = '';
      $arr['dados']['tipo_entrega'] = '';
      $arr['dados']['forma_pg'] = '';
      $arr['dados']['total_pg'] = 0;
      $arr['dados']['cep'] = '';
      $arr['dados']['rua'] = '';
      $arr['dados']['num'] = 0;
      $arr['dados']['bairro'] = '';
      $arr['dados']['municipio'] = '';
      $arr['dados']['uf'] = '';
      $arr['dados']['sabor_pizza'] = '';
      $arr['dados']['finalizar_pedido'] = '';
  
    }
    if ($id != null &&  $id>-1) {
      $idP = $id;
      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://127.0.0.1:5000/pedido/pizza/' . $idP,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false

      ]);
      $arr = json_decode(curl_exec($ch), true);
      curl_close($ch);

      $arr['dados'] = $arr[0];
    } 
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://127.0.0.1:5000/pedidos/pizzas',
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false

    ]);
    $arr['listagem'] = json_decode(curl_exec($ch), true);
    curl_close($ch);
    $arr['tipoEntrega'] = $usuarioModel->tipoEntrega;
    $arr['formaPg'] = $usuarioModel->formaPg;
        
    return view("telaListagemPizzasPedidos_view", $arr);
    // return view("telaListagemPizzasPedidos_view", $arr);

  }



    
  public function getPost(){ 
    $x = $_POST;
   
   if(isset($_POST['update']) == 'update'){
     $this->update();
     return redirect()->to(site_url('atendimentoPizzaFuncionario/index/'));
   }
   if (isset($_POST['limpar']) == 'limpar'){
    $this->index();
    return redirect()->to(site_url('atendimentoPizzaFuncionario/index/'));
  
  }
   else {
    return redirect()->to(site_url('atendimentoPizzaFuncionario/index/'));
   }
  
    
  }
  
  public function update()
  {
    
    $x = json_encode($_POST); 
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://127.0.0.1:5000/atualizar/pedidos/pizzas',
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POSTFIELDS => $x,
      CURLOPT_SSL_VERIFYPEER => false


    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    // var_dump($response);
    return redirect()->to(site_url('atendimentoPizzaFuncionario/index/'));

  }

    
  public function deletar($id)
  {
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://127.0.0.1:5000/delete/pedidos/pizzas/' . $id,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false


    ]);


    $response = curl_exec($ch);
    curl_close($ch);
    return redirect()->to(site_url('atendimentoPizzaFuncionario/index/'));
  }

}    