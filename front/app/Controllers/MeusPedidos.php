<?php

namespace App\Controllers;

class MeusPedidos extends BaseController
{


  /** 
   * Consumindo método get de api em Python
   */

  public function index($id = null)
  {
    $email = $_SESSION['usuario']['email'];
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://127.0.0.1:5000/meus/pedidos/bebida/'.$email,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false

    ]);
    $arr['pizzas']= json_decode(curl_exec($ch), true);
    curl_close($ch);
 

    return view("TelaMeusPedidos_view", $arr);
  }
}