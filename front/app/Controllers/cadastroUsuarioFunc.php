<?php

namespace App\Controllers;

class CadastroUsuarioFunc extends BaseController
{
  /** 
   * Consumindo método post de api em Python
   */
  public function index()
  {
    $x  = json_encode($_POST);

    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://127.0.0.1:3000/inserir/usuario',
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POSTFIELDS => $x,
      CURLOPT_SSL_VERIFYPEER => false


    ]);
    $resposta = curl_exec($ch);
    curl_close($ch);
    return view("telaAutoCadastro_view");
  }
}
