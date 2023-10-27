<?php

namespace App\Controllers;

class CadastrarBebida extends BaseController
{
    /** 
     * Consumindo método get de api em Python
     */
  
    public function index($id = null)
    {
      // var_dump($id);
     
      $usuarioModel = new \App\Models\UsuarioModel();
      if ($_GET == null) {
        $arr['dados']['id_bebida'] = -1;
        $arr['dados']['sabor_bebida'] = '';
        $arr['dados']['valor'] = 0;
        $arr['dados']['medida'] = '';
        $arr['dados']['tipo'] = '';
    
      }
      if ($id != null &&  $id>-1) {
        $idB = $id;
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://127.0.0.1:5000/bebida/' . $idB,
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
        CURLOPT_URL => 'http://127.0.0.1:5000/bebidas',
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false
  
      ]);
      $arr['listagem'] = json_decode(curl_exec($ch), true);
      curl_close($ch);
      $arr['niveis'] = $usuarioModel->niveis;
      $arr['tipo'] = $usuarioModel->tipo;
      $arr['volume'] = $usuarioModel->volume;
      return view('telaCadastrarBebida_view', $arr);
    }
  
  
  
  public function getPost(){ 
    $x = $_POST;
   
    var_dump($x);
    if (isset($_POST['salvar']) == 'salvar'){
       $this->salvar();
       return redirect()->to(site_url('cadastrarBebida/index/'));
  
    }
   if(isset($_POST['update']) == 'update'){
     $this->update();
     return redirect()->to(site_url('cadastrarBebida/index/'));
   }
   if (isset($_POST['limpar']) == 'limpar'){
    $this->index();
    return redirect()->to(site_url('cadastrarBebida/index/'));
  
  }
   else {
    return redirect()->to(site_url('cadastrarBebida/index/'));
   }
  
    
  }
  
  
    /** 
     * Consumindo método post de api em Python
     */
  
    public function salvar()
    {
      $x= json_encode($_POST);

      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://127.0.0.1:5000/inserir/bebida',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $x,
        CURLOPT_SSL_VERIFYPEER => false
  
  
      ]);
  
      $resposta = curl_exec($ch);
      curl_close($ch);
      return redirect()->to(site_url('cadastrarBebida/index/'));
    
  }
  
    public function deletar($id)
    {
      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://127.0.0.15000/delete/bebida/' . $id,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false
  
  
      ]);
  
  
      $response = curl_exec($ch);
      curl_close($ch);
      return redirect()->to(site_url('cadastrarBebida/index/'));
    }

    public function update()
    {
      
      $x = json_encode($_POST); 
      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://127.0.0.1:5000/atualizar/bebida',
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $x,
        CURLOPT_SSL_VERIFYPEER => false
  
  
      ]);
      $response = curl_exec($ch);
      curl_close($ch);
      // var_dump($response);
      return redirect()->to(site_url('cadastrarBebida/index/'));
  
  
  
  
    }
  }
  