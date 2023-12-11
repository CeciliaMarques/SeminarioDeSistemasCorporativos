<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
  protected $table = 'usuarios';
  protected $primaryKey = 'id_usuario';
  protected $returnType = 'array';
  protected $allowedFields = ['nome', 'email','telefone','cpf', 'nivel', 'senha'];
  protected $useTimestamps = false;

  protected $beforeInsert = ['hashPassword'];
  protected $beforeUpdate = ['hashPassword'];
  
  public $niveis = [
    NIVEL_ADMIN => "Administrador",
    NIVEL_FUNCIONARIO => "Funcionario",
    NIVEL_INACESSIVEL => "Sem Acesso"

  ];

  

  public $unidadeMedida = [
    "Selecione"=> "Selecione",
    "P"=> "P",
    "M" => "M",
    "G" => "G",
    "200ml"=> "200ml",
    "350ml"=> "350ml",
    "500ml"=> "500ml",
    "1L" => "1L",
    "1,5L" => "1,5L",
    "2L" => "2L",
    "2,5L" => "2,5L",
    "3L"=> "3L",
    "unidade"=>"unidade",
    "Fatia"=>"Fatia"

  ];
  
  public $formaPg = [
    "Cartão"=> "Cartão",
    "Pix" => "Pix",
    "TED" => "TED"

  ];
  
  
  public $tipoEntrega = [
    "Retirada"=> "Retirada",
    "Delivery" => "Delivery",

  ];
  
  public $status = [
    "Pedido Recebido"=> "Pedido Recebido",
    "Preparação em Andamento"=> "Preparação em Andamento",
    "No Forno" => "No Forno",
    "Em Rota de Entrega" => "Em Rota de Entrega",
    "Entregue" => "Entregue",
    "Cancelado" => "Cancelado",
    "Atrasado" => "Atrasado",
    "Pronto para Retirada" => "Pronto para Retirada"

  ];
    

}
