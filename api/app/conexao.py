from flask import Flask, jsonify
from werkzeug.security import generate_password_hash
import psycopg2
import sys

#Host do docker DB_HOST = '172.17.0.2'
DB_HOST = "localhost"
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

    # Commit (salvar) as mudanças
      con.commit()
      return jsonify("Criei as tabelas") 
def inserir_usuario(dados): 

      cursor.execute("INSERT INTO usuarios (nome, email, telefone, cpf, nivel, senha ) VALUES (%s, %s, %s, %s, %s, %s);",
                        (dados["nome"],  dados["email"], dados["telefone"], dados["cpf"],dados["nivel"], generate_password_hash(dados["senha"]) ))
      con.commit()
      return jsonify({'message': 'Cadastrado com sucesso.'}), 201

def atualizar_usuario(dados):
      cursor.execute("UPDATE usuarios SET nome = %s, email = %s, telefone = %s, cpf =%s, nivel = %s, senha = %s WHERE id_usuario =%s",
                              (dados["nome"], dados["email"], dados["telefone"], dados["cpf"], dados["nivel"],generate_password_hash(dados["senha"]), dados["id_usuario"]))
      con.commit()
      return jsonify({'message': 'Atualizado com sucesso.', 'data': dados}), 200 

def deletar_usuario(id_usuario):
    try:
        cursor.execute("DELETE FROM usuarios WHERE id_usuario = %s;", (id_usuario,))
        con.commit()

        return jsonify({'message': 'Deletado com sucesso.'}), 200
    
    except Exception as e:
        return jsonify({'message': 'Erro ao excluir o usuário.', 'error': str(e)}), 500
    finally:
            if con: 
                  #con.close()
                  pass
                  


def fechar_conexao():
      con.close()