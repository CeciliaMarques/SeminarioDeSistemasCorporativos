<?php

namespace App\Controllers;

class CadastroCategoria extends BaseController
{
  /** 
   * Consumindo método post de api em Python
   */
   
      public function index($id = null)
      {
       
        $usuarioModel = new \App\Models\UsuarioModel();
        if ($_GET == null) {
          $arr['dados']['id_categoria'] = -1;
          $arr['dados']['nome'] = '';
          $arr['dados']['descricao'] = '';
        
      
        }
        if ($id != null &&  $id>-1) {
          $idC = $id;
          $ch = curl_init();
          curl_setopt_array($ch, [
            CURLOPT_URL => 'http://api:5000/listar/categoria/' . $idC,
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
          // $a1 = json_encode($arr);
          // $arr1['dados'] = json_encode($arr[0]);
          // return $this->update($id);
        }
    
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://api:5000/listar/categorias',
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false
    
        ]);
        $arr['listagem'] = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return view('telaCadastrarCategoria_view', $arr);
      }
    
    
    
    public function getPost(){ 
      $x = $_POST;
     
      if (isset($_POST['salvar']) == 'salvar'){
         $this->salvar();
         return redirect()->to(site_url('cadastroCategoria/index/'));
    
      }
     if(isset($_POST['update']) == 'update'){
       $this->update();
       return redirect()->to(site_url('cadastroCategoria/index/'));
     }
     if (isset($_POST['limpar']) == 'limpar'){
      $this->index();
      return redirect()->to(site_url('cadastroCategoria/index/'));
    
    }
     else {
      return redirect()->to(site_url('cadastroCategoria/index/'));
     }
    
      
    }
    
    
      /** 
       * Consumindo método post de api em Python
       */
    
      public function salvar()
      {
        $x = json_encode($_POST);
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://api:5000/inserir/categoria',
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POSTFIELDS =>$x,
          CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
        ],
          CURLOPT_SSL_VERIFYPEER => false
    
    
        ]);
    
        $resposta = curl_exec($ch);
        curl_close($ch);
        return redirect()->to(site_url('cadastroCategoria/index/'));
      
    }
    
      public function deletar($id)
      {
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://api:5000/deletar/categoria/' . $id,
          CURLOPT_CUSTOMREQUEST => 'DELETE',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
        ],
          CURLOPT_SSL_VERIFYPEER => false
    
    
        ]);
    
    
        $resposta = curl_exec($ch);
        curl_close($ch);
        return redirect()->to(site_url('cadastroCategoria/index/'));
      }
  
      public function update()
      {
        
       $x = json_encode($_POST);
    
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://api:5000/atualizar/categoria',
          CURLOPT_CUSTOMREQUEST => 'PUT',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POSTFIELDS =>$x,
          CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $_SESSION['user']['token'] // Adicione o token ao cabeçalho
        ],
          CURLOPT_SSL_VERIFYPEER => false
    
    
        ]);
        $respota= curl_exec($ch);
        curl_close($ch);
        // var_dump($response);
        return redirect()->to(site_url('cadastroCategoria/index/'));
    
    
    
    
      }
    }