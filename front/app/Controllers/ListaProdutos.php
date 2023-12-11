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

    }
