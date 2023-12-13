<?php

namespace App\Controllers;

class AtendimentoPedidosFuncionario extends BaseController
{
  /** 
   * Consumindo método get de api em Python
   */

  public function index($id = null)
  {
    $arr['dados']=[];
    if ($_GET == null) {
    $arr['dados'] = [
      'id_pedido' => -1,
      'nome_cliente' => '',
      'email' => '',
      'id_produto' => -1,
      'id_usuario' => -1,
      'medida' => '',
      'tipo_entrega' => '',
      'forma_pg' => '',
      'total_pg' => 0,
      'quant' => 0,
      'cep' => '',
      'rua' => '',
      'num' => 0,
      'bairro' => '',
      'municipio' => '',
      'uf' => '',
      'referencia' => '',
      'produto' => '',
      'nome_fun' => '',
      'finalizar_pedido' => '',
      'data' => '',
      'hora' => '',

    ];
  }
    if ($id !== null &&  $id>-1) {
      $idP = $id;
      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://api:5000/listar/pedido/' . $idP,
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
      CURLOPT_URL => 'http://api:5000/listar/pedidos',
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false
    ]);

    $arr['listagem'] = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $usuarioModel = new \App\Models\UsuarioModel();
    $arr['unidadeMedida'] = $usuarioModel->unidadeMedida;
    $arr['tipoEntrega'] = $usuarioModel->tipoEntrega;
    $arr['formaPg'] = $usuarioModel->formaPg;
    $arr['status'] = $usuarioModel->status;



    return view("telaListagemPedidosFunc_view", $arr);
  }

  public function update()
  {
    $x = json_encode($_POST);
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://api:5000/atualizar/pedido',
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POSTFIELDS => $x,
      CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
      ],
      CURLOPT_SSL_VERIFYPEER => false


    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    // var_dump($response);
    return redirect()->to(site_url('AtendimentoPedidosFuncionario/index'));
  }


  public function deletar($id)
  {
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://api:5000/deletar/pedidos/' . $id,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
      ],
      CURLOPT_SSL_VERIFYPEER => false


    ]);


    $response = curl_exec($ch);
    curl_close($ch);
    return redirect()->to(site_url('AtendimentoPedidosFuncionario/index/'));
  }
  public function notificar($id){
    if ($id !== null &&  $id>-1) {
      $idP = $id;
      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://api:5000/listar/pedido/' . $idP,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false

      ]);
      $arr = json_decode(curl_exec($ch), true);
      curl_close($ch);
      $arr['dados'] = $arr[0];
    }
    if(isset($_POST) && !empty($_POST)){
      $x = json_encode($_POST);
      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://api:5000/enviar/email',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS =>$x,
      //   CURLOPT_HTTPHEADER => [
      //     'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
      // ],
        CURLOPT_SSL_VERIFYPEER => false
  
  
      ]);
  
      $resposta = curl_exec($ch);
      curl_close($ch);
      return redirect()->to(site_url('AtendimentoPedidosFuncionario/index/'));
    }

    return view("telaNotificar_view", $arr);
  }
}
