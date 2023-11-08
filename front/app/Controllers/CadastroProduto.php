<?php

namespace App\Controllers;

class CadastroProduto extends BaseController
{
    /** 
     * Consumindo método get de api em Python
     */
  
    public function index($id = null)
    {
      // var_dump($id);
     
      $usuarioModel = new \App\Models\UsuarioModel();
      if ($_GET == null) {
        $arr['dados']['id_produto'] = -1;
        $arr['dados']['id_categoria'] = -1;
        $arr['dados']['nome'] = '';
        $arr['dados']['unidade_medida'] = '';
        $arr['dados']['valor'] = 0;
    
      }
      if ($id != null &&  $id>-1) {
        $idP = $id;
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://127.0.0.1:5000/listar/produto/' . $idP,
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
        CURLOPT_URL => 'http://127.0.0.1:5000/listar/produtos',
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false
  
      ]);
      $arr['listagem'] = json_decode(curl_exec($ch), true);


      $catg = curl_init();
      curl_setopt_array( $catg, [
        CURLOPT_URL => 'http://127.0.0.1:5000/listar/categorias',
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false
  
      ]);
      
      $arr['categorias'] = json_decode(curl_exec( $catg), true);
      
      curl_close( $catg);
   
      $arr['unidade_medida'] = $usuarioModel->unidadeMedida;
      return view('telaCadastrarProduto_view', $arr);
    }
  
  
  
  public function getPost(){ 

    if (isset($_POST['salvar']) == 'salvar'){
       $this->salvar();
       return redirect()->to(site_url('cadastroProduto/index/'));
  
    }
   if(isset($_POST['update']) == 'update'){
     $this->update();
     return redirect()->to(site_url('cadastroProduto/index/'));
   }
   if (isset($_POST['limpar']) == 'limpar'){
    $this->index();
    return redirect()->to(site_url('cadastroProduto/index/'));
  
  }
   else {
    return redirect()->to(site_url('cadastroProduto/index/'));
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
        CURLOPT_URL => 'http://127.0.0.1:5000/inserir/produto',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $x,
        CURLOPT_HTTPHEADER => [
          'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
      ],
        CURLOPT_SSL_VERIFYPEER => false
  
  
      ]);
  
      $resposta = curl_exec($ch);
      curl_close($ch);
      return redirect()->to(site_url('cadastroProduto/index/'));
    
  }
  
    public function deletar($id)
    {
      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://127.0.0.1:5000/deletar/produto/'. $id,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
          'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
      ],
        CURLOPT_SSL_VERIFYPEER => false
  
  
      ]);
  
  
      $resposta = curl_exec($ch);
      curl_close($ch);
      return redirect()->to(site_url('cadastroProduto/index/'));
    }

    public function update()
    {
      
      $x = json_encode($_POST); 
      $ch = curl_init();
      curl_setopt_array($ch, [
        CURLOPT_URL => 'http://127.0.0.1:5000/atualizar/produto',
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $x,
        CURLOPT_HTTPHEADER => [
          'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
      ],
        CURLOPT_SSL_VERIFYPEER => false
  
  
      ]);
      $resposta = curl_exec($ch);
      curl_close($ch);
      // var_dump($response);
      return redirect()->to(site_url('cadastroProduto/index/'));
  
  
  
  
    }
  }
  