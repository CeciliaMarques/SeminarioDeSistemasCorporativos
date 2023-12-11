<?php

namespace App\Controllers;

class MeusPedidosEnviados extends BaseController
{
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
    'status'=>'',
    'tipo_entrega' => '',

  ];
  }
        $email=$_SESSION['usuario']['email'];
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://api:5000/listar/pedido/usuario/'.$email,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false
  
        ]);
        $dados = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $arr['listagem'] =  $dados;
        // dd($dados);
    return view("telaListaMeusPedidos", $arr);
        
    // }

    }

public function editar_pedido($id = null){

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
    $usuarioModel = new \App\Models\UsuarioModel();
    $arr['tipoEntrega'] = $usuarioModel->tipoEntrega;
    $arr['formaPg'] = $usuarioModel->formaPg;
    return view("telaEditarPedido_view", $arr);

  }



}

public function atualizar_pedido_cliente(){
  $x = json_encode($_POST);
  $ch = curl_init();
  curl_setopt_array($ch, [
    CURLOPT_URL => 'http://api:5000/atualizar/pedido',
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => $x,
    // CURLOPT_HTTPHEADER => [
    //   'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
    // ],
    CURLOPT_SSL_VERIFYPEER => false


  ]);
  $response = curl_exec($ch);
  curl_close($ch);
  var_dump($response);
  return redirect()->to(site_url('MeusPedidosEnviados/index'));



}
public function deletar($id)
      {
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://api:5000/deletar/pedido/' . $id,
          CURLOPT_CUSTOMREQUEST => 'DELETE',
          CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_HTTPHEADER => [
        //     'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
        // ],
          CURLOPT_SSL_VERIFYPEER => false
    
    
        ]);
    
    
        $resposta = curl_exec($ch);
        curl_close($ch);
        return redirect()->to(site_url('MeusPedidosEnviados/index'));
      }
  



}