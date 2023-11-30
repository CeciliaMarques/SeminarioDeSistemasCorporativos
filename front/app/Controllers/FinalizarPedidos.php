<?php

namespace App\Controllers;

class FinalizarPedidos extends BaseController
{

  public function index($id = null)
  {
    // $id_produto = 0;
    // $nome = "";
    // $valor = 0;
    // $total = 0;
    $usuarioModel = new \App\Models\UsuarioModel();
    $arr['tipoEntrega'] = $usuarioModel->tipoEntrega;
    $arr['formaPg'] = $usuarioModel->formaPg;
    return view('telaPedido_view', $arr);
  }

public function salvar(){
  if (isset($_POST)) {
    $nome_cliente = $_POST['nome_cliente'];
    $email = $_POST['email'];
    $tipo_entrega = $_POST['tipo_entrega'];
    $forma_pg = $_POST['forma_pg'];
    $id_usuario = $_POST['id_usuario'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $num = $_POST['num'];
    $bairro = $_POST['bairro'];
    $municipio = $_POST['municipio'];
    $uf = $_POST['uf'];
    $referencia = $_POST['referencia'];
    $status = $_POST['status'];
    $finalizar_pedido = $_POST['finalizar_pedido'];
    $nome_fun = $_POST['nome_fun'];

    $produtos = [];

    foreach ($_SESSION['dados'] as $produto) {
        $produtos[] = [
            'id_produto' => $produto['id_produto'],
            'produto' => $produto['nome'],
            'medida' => $produto['medida'],
            'total_pg' => $produto['total_pg'],
            'quant' => $produto['quant']
        ];
    }

    $pedido = [
        'nome_cliente' => $nome_cliente,
        'email' => $email,
        'id_usuario' => $id_usuario,
        'tipo_entrega' => $tipo_entrega,
        'forma_pg' => $forma_pg,
        'cep' => $cep,
        'rua' => $rua,
        'num' => $num,
        'bairro' => $bairro,
        'municipio' => $municipio,
        'uf' => $uf,
        'referencia' => $referencia,
        'status' => $status,
        'finalizar_pedido' => $finalizar_pedido,
        'nome_fun' => $nome_fun,
        'produtos' => $produtos, 

        // 'id_produto' => $produto['id_produto'],
        // 'produto' => $produto['nome'],
        // 'medida' => $produto['medida'],
        // 'total_pg' => $produto['total_pg'],
        // 'quant' => $produto['quant']
    ];

    $json_pedido = json_encode($pedido);
// dd( $json_pedido );
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => 'http://api:5000/inserir/pedido',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $json_pedido,
        CURLOPT_SSL_VERIFYPEER => false
    ]);

    $resposta = curl_exec($ch);
    curl_close($ch);

    // Restante do código...
}
}
}