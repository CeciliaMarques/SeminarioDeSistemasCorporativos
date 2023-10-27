<?php

namespace App\Controllers;

class Bebidas extends BaseController
{
    public function index()
    {     
    $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => 'http://127.0.0.1:5000/bebidas',
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false
    
        ]);
        $arr['bebidas'] = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return view('telaCardapioBebidas_view', $arr);
    }
}