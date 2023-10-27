<?php

namespace App\Controllers;

class ListagemPedidosFinalizadosAdminPizza extends BaseController
{


  /** 
   * Consumindo método get de api em Python
   */

  public function index($id = null)
  {
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://127.0.0.1:5000/pedidos/pizzas/finalizados',
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false

    ]);
    $arr['listagem'] = json_decode(curl_exec($ch), true);
    curl_close($ch);

    return view("telaPedidosFinalizadosPizzaAdmin_view", $arr);

}

public function deletar($id)
{
  $ch = curl_init();
  curl_setopt_array($ch, [
    CURLOPT_URL => 'http://127.0.0.1:5000/delete/pedidos/pizzas/finalizados/' . $id,
    CURLOPT_CUSTOMREQUEST => 'DELETE',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false


  ]);


  $response = curl_exec($ch);
  curl_close($ch);
  return redirect()->to(site_url('listagemPedidosFinalizadosAdminPizza/index/'));
}
}