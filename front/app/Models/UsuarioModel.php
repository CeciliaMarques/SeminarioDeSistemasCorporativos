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
    "500ml"=> "500ml",
    "1L" => "1L",
    "1,5L" => "1,5L",
    "2L" => "2L",
    "2,5L" => "2,5L",
    "unidade"=>"unidade"

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
  
  public $volume = [
    "200ml"=> "200ml",
    "500ml"=> "500ml",
    "1L" => "1L",
    "1,5L" => "1,5L",
    "2L" => "2L",
    "2,5L" => "2,5L"

  ];
    

}
