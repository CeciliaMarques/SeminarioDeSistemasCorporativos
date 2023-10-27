<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
  protected $table = 'usuarios_f';
  protected $primaryKey = 'id_usuariof';
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

  

  public $tamanhoPizza = [
    "P"=> "P",
    "M" => "M",
    "G" => "G"

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
    
  public $tipo = [
    "Suco"=> "Suco",
    "Refrigerante"=> "Refrigerante",
  
  ];


  protected function hashPassword(array $data)
  {
    // #se a senha nao tiver sido enviada não faz nada 
    // if (isset($this->post["senha"]) == "") {
    //   if (isset($data["data"]["senha"]) == "") {
    //     return $data;
    //   }
    // }
    // $data["data"]["senha"] = sha1($data["data"]["senha"]);
    // return $data;
  }
  public function logar($dados)
  {
      if (isset($_POST["email"]) != "" && ($_POST["email"]) != null) {
        if (isset($_POST["senha"]) != "" && ($_POST["senha"] != null)) {
        //   $senha = sha1($dados["senha"]);
          $this->where("email", $dados["email"]);
          $this->where("senha", $dados["senha"]);
          return $this->first();
        }
      }else {
   
      return redirect()->to(site_url("home/tela_login"));
    }
  }
  public function findByEmail($id, $email)
  {
    $this->select("nome");
    $this->where("email", $email);
    $this->where("id !=", $id);
    return $this->first();
  }


  public function procurarEmail($email)
  {
    $this->where("email", $email);
    return $this->first();
  }

  public function findByHash($hash)
  {
    $this->where("hash_senha", $hash);
    return $this->first();
  }
  public function alterarSenhaByHash($dados)
  {
    $this->where("hash_senha", $dados['hash']);
    $this->set("senha", $dados["senha"]);
    $this->set("hash_senha", null);
    return $this->update();
  }

  public function filtrar()
  {
    $this->orderBy("nome", "asc");
    return $this->paginate(5);
  }
}
