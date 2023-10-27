<?php

namespace App\Controllers;

class FinalizarPedidosBebida extends BaseController
{

public function index($id = null )
    {  

        $usuarioModel = new \App\Models\UsuarioModel();
        // if ($_GET == null) {
        //   $arr['dados']['id_pizza'] = -1;
        //   $arr['dados']['sabor_pizza'] = '';
        //   $arr['dados']['valor'] = 0;
        //   $arr['dados']['tamanho'] = '';
      
        // }
        // if ($id != null &&  $id>-1) {
          $idP = $id;
          $ch = curl_init();
          curl_setopt_array($ch, [
            CURLOPT_URL => 'http://127.0.0.1:5000/bebida/' . $idP,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
    
          ]); 
                $arr = json_decode(curl_exec($ch), true);
                curl_close($ch);
                $arr['dados'] = $arr[0];
                $_SESSION['dados'] = $arr;
               
               
                $arr['tipoEntrega'] = $usuarioModel->tipoEntrega;
                $arr['formaPg'] = $usuarioModel->formaPg;
                
              return view('telaPedidoBebida_view', $arr);
            // return view('telaCardapioPizza_view');
        }
      
        public function getPost(){ 
          $x = $_POST;
          $id = $_POST['id_bebida'];
          if (isset($_POST['salvar']) == 'salvar'){
             $this->salvar();
             $this->session->setFlashdata('success', 'Pedido salvo com sucesso.');
             return redirect()->to(site_url("FinalizarPedidosBebida/index/$id"));
        
          }
         if (isset($_POST['limpar']) == 'limpar'){
          $this->index();
          return redirect()->to(site_url("FinalizarPedidosBebida/index/$id"));
        
        }
         else {
          return redirect()->to(site_url("FinalizarPedidosBebida/index/$id"));
         }
        
          
        }
        public function salvar()
        { 
            $x = json_encode($_POST);
            $id = $_POST['id_bebida'];
          
            $ch = curl_init();
            curl_setopt_array($ch, [
              CURLOPT_URL => 'http://127.0.0.1:5000/inserir/pedido/bebida',
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_POSTFIELDS =>$x,
              CURLOPT_SSL_VERIFYPEER => false
        
        
            ]);
        
            $resposta = curl_exec($ch);
            curl_close($ch);
            return redirect()->to(site_url("FinalizarPedidosBebida/index/$id"));
        }
    
        
        

      
    }
