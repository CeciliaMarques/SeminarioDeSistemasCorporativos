<?php

namespace App\Controllers;

class ContaUsuario extends BaseController
{
    /** 
     * Consumindo método get de api em Python
     */
  
    public function index($id = null)
    {
      // var_dump($id);
     

$ch = curl_init();
        $id = $_SESSION["user"]["id_usu"];
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://127.0.0.1:5000/listar/usuario/' . $id,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
        ],
          CURLOPT_SSL_VERIFYPEER => false


        ]);
           
     $arr = json_decode(curl_exec($ch), true);
      curl_close($ch);
      $arr['dados'] = $arr[0];
     
  
      return view("telaEditarAdmin_view", $arr);
}  

public function update()
{
$x = json_encode($_POST);

  $ch = curl_init();
  curl_setopt_array($ch, [
    CURLOPT_URL => 'http://127.0.0.1:5000/atualizar/usuario',
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
  $this->session->setFlashdata('success', 'Atualizado com sucesso!');
  return redirect()->to(site_url("contaUsuario/index/"));
}  
}  