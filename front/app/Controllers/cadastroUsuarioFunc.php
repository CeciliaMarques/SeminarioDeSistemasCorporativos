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
      CURLOPT_URL => 'http://api:5000/inserir/usuario',
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POSTFIELDS => $x,
      CURLOPT_SSL_VERIFYPEER => false


    ]);
    $resposta = curl_exec($ch);
    curl_close($ch);

    $respostaArray = json_decode($resposta, true);
    if(!empty($respostaArray['message']) && $respostaArray ['message'] == 'Cadastrado com sucesso.'){
      $this->session->setFlashdata('success', 'Cadastrado com sucesso.');
      return redirect()->to(site_url("CadastroUsuarioFunc/index"));
    }
    else{
      $this->session->setFlashdata('erro', 'O e-mail já existe.');
      return redirect()->to(site_url("CadastroUsuarioFunc/index/"));
    }
    return view("telaAutoCadastro_view");
  }
}
