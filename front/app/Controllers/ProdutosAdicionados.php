<?php

namespace App\Controllers;

class ProdutosAdicionados extends BaseController
{

  public function index(){

    return view("TelaMeusPedidosCarrinho_view");
  }
  public function adicionarItens($id = null)
  {
    if (!empty($id)) {
      if (!isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id] = 1;
      } else {
        $_SESSION['carrinho'][$id] += 1;
      }
    }

    return redirect()->to(site_url('ProdutosAdicionados'));
  }

  public function atualizarItens()
  {
    if(isset($_POST['prod'])){
      foreach($_POST['prod'] as $id=>$quant) {  
        $id = intval($id);
        $quant = intval($quant);
        if(!empty($quant) || $quant !== 0){
          $_SESSION['carrinho'][$id] = $quant;
        }else{
          unset($_SESSION['carrinho'][$id]);
        }


      }
      return redirect()->to(site_url('ProdutosAdicionados'));
    }
  }

  public function removerItens($id = null)
  {
    if (isset($_SESSION['carrinho'][$id])) {
      unset($_SESSION['carrinho'][$id]);
    }
    return redirect()->to(site_url('ProdutosAdicionados'));
  }
}
