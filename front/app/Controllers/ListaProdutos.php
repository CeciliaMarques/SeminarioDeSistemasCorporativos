<?php

namespace App\Controllers;

class ListaProdutos extends BaseController
{

public function index($id = null)
    {  

          $ch = curl_init();
          curl_setopt_array($ch, [
            CURLOPT_URL => 'http://api:5000/listar/categoria/produtos/' .$id,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
    
          ]); 
                $arr = json_decode(curl_exec($ch), true);
                curl_close($ch);
                // dd( $arr);
                if(empty($arr)){
                  $arr['listagem'] =[];
                }else{
                $arr['listagem'] = $arr;
            
                // $_SESSION['dados'] = $arr;
               
                }
              return view('telaListaProdutosCardapio_view', $arr);
            // return view('telaCardapioPizza_view');
        }
      
        public function getPost(){ 
          $x = $_POST;
          $id = $_POST['id_categoria'];
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
