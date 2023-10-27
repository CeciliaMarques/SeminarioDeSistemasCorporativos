<?php

namespace App\Controllers;

class CadastroPizza extends BaseController
{
  /** 
   * Consumindo método post de api em Python
   */
   
      public function index($id = null)
      {
       
        $usuarioModel = new \App\Models\UsuarioModel();
        if ($_GET == null) {
          $arr['dados']['id_pizza'] = -1;
          $arr['dados']['sabor_pizza'] = '';
          $arr['dados']['valor'] = 0;
          $arr['dados']['tamanho'] = '';
      
        }
        if ($id != null &&  $id>-1) {
          $idP = $id;
          $ch = curl_init();
          curl_setopt_array($ch, [
            CURLOPT_URL => 'http://127.0.0.1:5000/pizza/' . $idP,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
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
          CURLOPT_URL => 'http://127.0.0.1:5000/pizzas',
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false
    
        ]);
        $arr['listagem'] = json_decode(curl_exec($ch), true);
        curl_close($ch);

      
        $arr['tamanhoPizza'] = $usuarioModel->tamanhoPizza;
        return view('telaCadastrarPizza_view', $arr);
      }
    
    
    
    public function getPost(){ 
      $x = $_POST;
     
      if (isset($_POST['salvar']) == 'salvar'){
         $this->salvar();
         return redirect()->to(site_url('cadastroPizza/index/'));
    
      }
     if(isset($_POST['update']) == 'update'){
       $this->update();
       return redirect()->to(site_url('cadastroPizza/index/'));
     }
     if (isset($_POST['limpar']) == 'limpar'){
      $this->index();
      return redirect()->to(site_url('cadastroPizza/index/'));
    
    }
     else {
      return redirect()->to(site_url('cadastroPizza/index/'));
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
          CURLOPT_URL => 'http://127.0.0.1:5000/inserir/pizza',
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POSTFIELDS =>$x,
          CURLOPT_SSL_VERIFYPEER => false
    
    
        ]);
    
        $resposta = curl_exec($ch);
        curl_close($ch);
        return redirect()->to(site_url('cadastroPizza/index/'));
      
    }
    
      public function deletar($id)
      {
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://127.0.0.1:5000/delete/pizza/' . $id,
          CURLOPT_CUSTOMREQUEST => 'DELETE',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false
    
    
        ]);
    
    
        $response = curl_exec($ch);
        curl_close($ch);
        return redirect()->to(site_url('cadastroPizza/index/'));
      }
  
      public function update()
      {
        
       $x = json_encode($_POST);
    
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://127.0.0.1:5000/atualizar/pizza',
          CURLOPT_CUSTOMREQUEST => 'PUT',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POSTFIELDS =>$x,
          CURLOPT_SSL_VERIFYPEER => false
    
    
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        // var_dump($response);
        return redirect()->to(site_url('cadastroPizza/index/'));
    
    
    
    
      }
    }