from flask import Flask, jsonify
from werkzeug.security import generate_password_hash,  check_password_hash
from flask_jwt_extended import create_access_token
import psycopg2
import sys

#Host do docker DB_HOST = '172.17.0.2'
DB_HOST = "db"
DB_NOME = "bancoDsc"
DB_USU = "postgres"
DB_SENHA = "12345"

sslmode = "require"

try:
           
      con = psycopg2.connect(host= DB_HOST, dbname = DB_NOME, user = DB_USU, password = DB_SENHA)
except psycopg2.Error as e:
      print ("Não conectado!")
      print (e.pgerror)
      print (e.diag.message_detail)
      sys.exit(1)
else:
      print ("Conectado!")

      cursor = con.cursor() 
   

def criar_tabelas():
      
      cursor.execute("CREATE TABLE IF NOT EXISTS usuarios (id_usuario serial PRIMARY KEY, nome VARCHAR(50), email VARCHAR(50),"
                     "telefone VARCHAR,  cpf VARCHAR(14), nivel INTEGER, senha VARCHAR(200));")
      
      cursor.execute("CREATE TABLE IF NOT EXISTS categorias (id_categoria serial PRIMARY KEY, nome VARCHAR(50), descricao VARCHAR);")

      cursor.execute("CREATE TABLE IF NOT EXISTS produtos (id_produto serial PRIMARY KEY, nome VARCHAR(50), id_categoria INTEGER, unidade_medida VARCHAR, valor NUMERIC,"
                     "FOREIGN KEY(id_categoria) REFERENCES categorias);")
      
      
      cursor.execute("CREATE TABLE IF NOT EXISTS pedidos(id_pedido serial PRIMARY KEY,"
                        "nome_cliente VARCHAR(40), email VARCHAR(40),"
                        "id_usuario INTEGER,  tipo_entrega VARCHAR(40),"
                        "forma_pg VARCHAR, cep VARCHAR(20),"
                        "rua VARCHAR(50), num INTEGER, bairro VARCHAR(40), municipio VARCHAR, "
                        "uf VARCHAR(2), referencia VARCHAR, status VARCHAR,"
                        "finalizar_pedido VARCHAR(10),nome_fun VARCHAR(40),"
                        "id_produto INTEGER,produto VARCHAR(40), medida VARCHAR(40), total_pg NUMERIC, quant INTEGER," 
                        "data_hora  TIMESTAMP DEFAULT CURRENT_TIMESTAMP, "
                        "FOREIGN KEY(id_produto) REFERENCES produtos);")
      con.commit()
      return jsonify("Criei as tabelas") 
    
#operações de usuários
def inserir_usuario(dados): 
     cursor.execute("SELECT * FROM  usuarios where  email = %s",(dados ['email'],))
     linhas = cursor.fetchall()
     if len(linhas) == 0:
            cursor.execute("INSERT INTO usuarios (nome, email, telefone, cpf, nivel, senha ) VALUES (%s, %s, %s, %s, %s, %s);",
                    (dados["nome"],  dados["email"], dados["telefone"], dados["cpf"],dados["nivel"], generate_password_hash(dados["senha"]) ))
            con.commit()
            return jsonify({"message": 'Cadastrado com sucesso.'}), 201
     else:
             return jsonify({"msg":'O e-mail já existe'})
    

def deletar_usuario(id_usuario):
    try:
        cursor.execute("DELETE FROM usuarios WHERE id_usuario=\'{}\'".format(id_usuario))
        con.commit()

        return jsonify({"message": "Excluido com sucesso."}), 200
    
    
    except psycopg2.IntegrityError as e:
         con.rollback()
         return jsonify({"message": "O dado que você selecionou está integrado a outras tabelas.", "error": str(e)}), 500

    except Exception as e:
        con.rollback()
        return jsonify({"message": "Erro ao excluir.", "error": str(e)}), 500
    
    finally:
        if con:
            pass

def listar_usuarios():
       cursor.execute("SELECT * FROM usuarios")
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_usuario": resultado[0], "nome": resultado[1], "email": resultado[2], "telefone":resultado[3], "cpf":resultado[4], "nivel": resultado[5],"senha": resultado[6]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor)  
                 
def listar_usuario(id_usuario):
            cursor.execute("SELECT * FROM usuarios  WHERE  id_usuario=\'{}\'".format(id_usuario))
            linhas = cursor.fetchall()
            vetor = []
            chaves = {}
            for resultado in linhas:
                  chaves = {"id_usuario": resultado[0], "nome": resultado[1], "email": resultado[2], "telefone":resultado[3], "cpf":resultado[4], "nivel": resultado[5],"senha": resultado[6]} 
                  vetor.append(chaves) 
                  # chaves = {}  
            return jsonify(vetor) 

def logar(dados):
    email = dados["email"]
    senha = dados["senha"]

    cursor.execute("SELECT * FROM usuarios WHERE email = %s", (email,))
    linhas = cursor.fetchall()
    vetor = []

    for resultado in linhas:
        id_usuario, nome, email, telefone, cpf, nivel, hashed_senha = resultado

        if check_password_hash(hashed_senha, senha):
            chaves = {
                'id_usuario': id_usuario,
                'nome': nome,
                'email': email,
                'telefone': telefone,
                'cpf': cpf,
                'nivel': nivel
            }
            access_token = create_access_token(identity=email)
            vetor.append(chaves)

    if vetor:
        return jsonify({"dados":vetor, "token": access_token})
    else:
        return jsonify({'message': 'Credenciais inválidas'}), 401


def fechar_conexao():
      con.close()