from flask import Flask, jsonify
from werkzeug.security import generate_password_hash,  check_password_hash
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
      
      cursor.execute("CREATE TABLE IF NOT EXISTS categorias (id_categoria serial PRIMARY KEY, nome VARCHAR(50), descricao VARCHAR);")

      cursor.execute("CREATE TABLE IF NOT EXISTS produtos (id_produto serial PRIMARY KEY, nome VARCHAR(50), id_categoria INTEGER, unidade_medida VARCHAR, valor NUMERIC,"
                     "FOREIGN KEY(id_categoria) REFERENCES categorias);")
      
      cursor.execute("CREATE TABLE IF NOT EXISTS pedidos(id_pedido serial PRIMARY KEY, "
                          " nome_cliente VARCHAR(40), email VARCHAR(40),"
                           "id_produto INTEGER, id_usuario INTEGER, medida VARCHAR, tipo_entrega VARCHAR(40),"
                           "forma_pg VARCHAR, total_pg NUMERIC, cep VARCHAR(20),"
                           "rua VARCHAR(50), num INTEGER, bairro VARCHAR(40), municipio VARCHAR, uf VARCHAR(2), referencia VARCHAR,"
                           "produto VARCHAR(40), status VARCHAR,finalizar_pedido VARCHAR(10)," 
                           "nome_fun VARCHAR(40), data_pedido TIMESTAMP, quant INTEGER, "
                           "FOREIGN KEY(id_usuario) REFERENCES usuarios,"
                           "FOREIGN KEY(id_produto) REFERENCES produtos);")

    # Commit (salvar) as mudanças
      con.commit()
      return jsonify("Criei as tabelas") 

#operações de usuários
def inserir_usuario(dados): 

      cursor.execute("INSERT INTO usuarios (nome, email, telefone, cpf, nivel, senha ) VALUES (%s, %s, %s, %s, %s, %s);",
                        (dados["nome"],  dados["email"], dados["telefone"], dados["cpf"],dados["nivel"], generate_password_hash(dados["senha"]) ))
      con.commit()
      return jsonify({"message": 'Cadastrado com sucesso.'}), 201

def atualizar_usuario(dados):
      cursor.execute("UPDATE usuarios SET nome = %s, email = %s, telefone = %s, cpf =%s, nivel = %s, senha = %s WHERE id_usuario =%s",
                              (dados["nome"], dados["email"], dados["telefone"], dados["cpf"], dados["nivel"],generate_password_hash(dados["senha"]), dados["id_usuario"]))
      con.commit()
      return jsonify({"message": "Atualizado com sucesso.", "data": dados}), 200 

def deletar_usuario(id_usuario):
    try:
        cursor.execute("DELETE FROM usuarios WHERE id_usuario=\'{}\'".format(id_usuario))
        con.commit()

        return jsonify({"message": "Excluido com sucesso."}), 200
    
    except Exception as e:
        return jsonify({"message": "Erro ao excluir o usuário.", "error": str(e)}), 500
    finally:
            if con: 
                  #con.close()
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


 #Operações de categorias  
def inserir_categoria(dados): 

      cursor.execute("INSERT INTO categorias (nome, descricao) VALUES (%s, %s);",
                        (dados["nome"],  dados["descricao"]))
      con.commit()
      return jsonify({'message': 'Categoria cadastrada com sucesso.'}), 201

def atualizar_categoria(dados):
      cursor.execute("UPDATE categorias SET nome = %s, descricao = %s  WHERE id_categoria =%s",
                              (dados["nome"], dados["descricao"], dados["id_categoria"]))
      con.commit()
      return jsonify({'message': 'Categoria atualizado com sucesso.', 'data': dados}), 200 

def deletar_categoria(id_categoria):
    try:
        cursor.execute("DELETE FROM categorias WHERE id_categoria=\'{}\'".format(id_categoria))
        con.commit()

        return jsonify({"message": "Categoria excluída com sucesso."}), 200
    
    except Exception as e:
        return jsonify({"message": "Erro ao excluir categoria.", "error": str(e)}), 500
    finally:
            if con: 
                  #con.close()
                  pass
def listar_categorias():
       cursor.execute("SELECT * FROM categorias")
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_categoria": resultado[0], "nome": resultado[1], "descricao": resultado[2]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor)  

def listar_categoria(id_categoria):
            cursor.execute("SELECT * FROM categorias WHERE  id_categoria=\'{}\'".format(id_categoria))
            linhas = cursor.fetchall()
            vetor = []
            chaves = {}
            for resultado in linhas:
                  chaves = {"id_categoria": resultado[0], "nome": resultado[1], "descricao": resultado[2]} 
                  vetor.append(chaves) 
                  # chaves = {}  
            return jsonify(vetor) 

#operações de produtos
def inserir_produto(dados): 

      cursor.execute("INSERT INTO produtos (nome, id_categoria, unidade_medida, valor) VALUES (%s, %s, %s, %s);",
                        (dados["nome"],  dados["id_categora"], dados["unidade_medida"], dados["valor"]))
      con.commit()
      return jsonify({"message": "Produto cadastrado com sucesso."}), 201

def atualizar_produto(dados):
      cursor.execute("UPDATE produtos SET nome = %s, id_categoria = %s, unidade_medida = %s, valor = %s  WHERE id_produto =%s",
                              (dados["nome"], dados["id_categoria"], dados["unidade_medida"], dados["valor"], dados["id_produto"]))
      con.commit()
      return jsonify({"message": "Produto atualizado com sucesso.", "data": dados}), 200 

def deletar_produto(id_produto):
    try:
        cursor.execute("DELETE FROM produtos WHERE id_produto=\'{}\'".format(id_produto))
        con.commit()

        return jsonify({"message": "Produto excluído com sucesso."}), 200
    
    except Exception as e:
        return jsonify({"message": "Erro ao excluir produto.", "error": str(e)}), 500
    finally:
            if con: 
                  #con.close()
                  pass
def listar_produtos():
       cursor.execute("SELECT * FROM produtos")
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_produto": resultado[0], "nome": resultado[1], "id_categoria": resultado[2], "unidade_medida":resultado[3], "valor":resultado[4]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor) 
             
def listar_produto(id_produto):
       cursor.execute("SELECT * FROM produtos WHERE  id_produto=\'{}\'".format(id_produto))
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_produto": resultado[0], "nome": resultado[1], "id_categoria": resultado[2], "unidade_medida":resultado[3], "valor":resultado[4]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor) 

#operações de pedidos
def inserir_pedido(dados): 

      cursor.execute("INSERT INTO pedidos (nome_cliente, email, id_produto, id_usuario, medida,"
                     "tipo_entrega, forma_pg, total_pg, cep, rua, num, bairro, municipio, uf, referencia,"
                     "produto, status, finalizar_pedido, nome_fun, data_pedido, quant) VALUES (%s, %s, %s, %s, %s,"
                     " %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);",
                        (dados["nome_cliente"],  dados["email"], dados["id_produto"], dados["id_usuario"],
                         dados["medida"], dados["tipo_entrega"], dados["forma_pg"], dados["total_pg"],
                         dados["cep"], dados["rua"], dados["num"], dados["bairro"], dados["municipio"],
                         dados["uf"], dados["referencia"], dados["produto"], dados["status"], dados["finalizar_pedido"],
                         dados["nome_fun"], dados["data_pedido"], dados["quant"]))
      con.commit()
      return jsonify({"message": "Pedido cadastrado com sucesso."}), 201

def atualizar_pedido(dados):
      cursor.execute("UPDATE pedidos SET nome_cliente = %s, email = %s, id_produto = %s, id_usuario = %s, medida = %s,"
                     "tipo_entrega = %s, forma_pg = %s, total_pg = %s, cep = %s, rua = %s, num = %s, bairro = %s, municipio = %s," 
                     "uf = %s, referencia = %s, produto = %s, status = %s, finalizar_pedido = %s, nome_fun = %s, data_pedido = %s, quant = %s  WHERE id_pedido =%s",
                        (dados["nome_cliente"],  dados["email"], dados["id_produto"], dados["id_usuario"],
                         dados["medida"], dados["tipo_entrega"], dados["forma_pg"], dados["total_pg"],
                         dados["cep"], dados["rua"], dados["num"], dados["bairro"], dados["municipio"],
                         dados["uf"], dados["referencia"], dados["produto"], dados["status"], dados["finalizar_pedido"],
                         dados["nome_fun"], dados["data_pedido"], dados["quant"], dados["id_pedido"]))      
      con.commit()
      return jsonify({"message": "Produto atualizado com sucesso.", "data": dados}), 200 

def deletar_pedido(id_pedido):
    try:
        cursor.execute("DELETE FROM pedidos WHERE id_pedido=\'{}\'".format(id_pedido))
        con.commit()

        return jsonify({"message": "Pedidos excluído com sucesso."}), 200
    
    except Exception as e:
        return jsonify({"message": "Erro ao excluir Pedido.", "error": str(e)}), 500
    finally:
            if con: 
                  #con.close()
                  pass
def listar_pedidos():
       cursor.execute("SELECT * FROM pedidos")
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_pedido": resultado[0], "nome_cliente": resultado[1], "email": resultado[2],
                     "id_produto":resultado[3], "id_usuario":resultado[4],"medida":resultado[5], 
                     "tipo_entrega":resultado[6], "forma_pg":resultado[7], "total_pg":resultado[8],
                     "cep":resultado[9], "rua":resultado[10], "num":resultado[11],"bairro":resultado[12],
                     "municipio":resultado[13], "uf":resultado[14], "referencia":resultado[15], "produto":resultado[16],
                     "status":resultado[17], "finalizar_pedido":resultado[18], "nome_func":resultado[19], "data_pedido":resultado[20], "quant":resultado[21]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor)  

def listar_pedido(id_pedido):
       cursor.execute("SELECT * FROM pedidos WHERE  id_pedido=\'{}\'".format(id_pedido))
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_pedido": resultado[0], "nome_cliente": resultado[1], "email": resultado[2],
                     "id_produto":resultado[3], "id_usuario":resultado[4],"medida":resultado[5], 
                     "tipo_entrega":resultado[6], "forma_pg":resultado[7], "total_pg":resultado[8],
                     "cep":resultado[9], "rua":resultado[10], "num":resultado[11],"bairro":resultado[12],
                     "municipio":resultado[13], "uf":resultado[14], "referencia":resultado[15], "produto":resultado[16],
                     "status":resultado[17], "finalizar_pedido":resultado[18], "nome_func":resultado[19], "data_pedido":resultado[20], "quant":resultado[21]} 
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
            vetor.append(chaves)

    if vetor:
        return jsonify(vetor)
    else:
        return jsonify({'message': 'Credenciais inválidas'}), 401


def fechar_conexao():
      con.close()