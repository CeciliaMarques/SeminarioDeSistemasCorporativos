<?php

namespace App\Controllers;

class CadastroFunc extends BaseController
{


  /** 
   * Consumindo método get de api em Python
   */

  public function index($id = null)
  {
    // var_dump($id);
   
    $usuarioModel = new \App\Models\UsuarioModel();
    if ($_GET == null) {
      $arr['dados']['id_usuario'] = -1;
      $arr['dados']['nome'] = '';
      $arr['dados']['cpf'] = '';
      $arr['dados']['email'] = '';
      $arr['dados']['telefone'] = '';
      $arr['dados']['nivel'] = 0;
      $arr['dados']['senha'] = '';
    }
    if ($id != null &&  $id>-1) {
      $idU = $id;
      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://127.0.0.1:5000/listar/usuario/' . $idU,
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
    }

    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://127.0.0.1:5000/listar/usuarios',
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
    ],
      CURLOPT_SSL_VERIFYPEER => false

    ]);
    $arr['listagem'] = json_decode(curl_exec($ch), true);
    curl_close($ch);
    $arr['niveis'] = $usuarioModel->niveis;
    return view("telaCadastrarFunc_view", $arr);
  }



public function getPost(){ 
  $x = $_POST;
 
  var_dump($x);
  if (isset($_POST['salvar']) == 'salvar'){
     $this->salvar();
     return redirect()->to(site_url("cadastroFunc/index/"));

  }
 if(isset($_POST['update']) == 'update'){
   $this->update();
   return redirect()->to(site_url("cadastroFunc/index/"));
 }
 if (isset($_POST['limpar']) == 'limpar'){
  $this->index();
  return redirect()->to(site_url("cadastroFunc/index/"));

}
 else {
  return redirect()->to(site_url("cadastroFunc/index/"));
 }

  
}


  /** 
   * Consumindo método post de api em Python
   */

  public function salvar()
  {

  $x  = json_encode($_POST); 

    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://127.0.0.1:5000/inserir/usuario',
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POSTFIELDS => $x,
      CURLOPT_SSL_VERIFYPEER => false


    ]);
    $resposta = curl_exec($ch);
    curl_close($ch);
    return redirect()->to(site_url("cadastroFunc/index/"));
  
}

  /** 
   * Consumindo método delete  de api em Python
   */
  public function deletar($id)
  {
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => 'http://127.0.0.1:5000/deletar/usuario/' . $id,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
    ],
      CURLOPT_SSL_VERIFYPEER => false


    ]);


    $response = curl_exec($ch);
    curl_close($ch);
    return redirect()->to(site_url("cadastroFunc/index"));
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
    // var_dump($response);
    return redirect()->to(site_url("cadastroFunc/index/"));




  }
}
