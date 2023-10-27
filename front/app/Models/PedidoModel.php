<?php namespace App\Models; 
use CodeIgniter\Model; 

class PedidoModel extends Model { 
 protected $table = 'pedido'; 
 protected $primaryKey = 'id_pedido'; 
 protected $returnType = 'array'; 
 protected $allowedFields = ['nome_cliente', 'sabores_pizza', 'bebidas', 'forma_pg','telefone','cep', 'rua', 'numero','bairro', 'municipio','uf','id_usu']; 
 protected $useTimestamps = false; 

 public function filtrar($filtros)
 {
  
   return $this->paginate(5);
 }
}