from flask import Flask, jsonify
from werkzeug.security import generate_password_hash,  check_password_hash
from flask_jwt_extended import create_access_token
# from datetime import datetime
import smtplib
import email.message
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
                        "nome_cliente VARCHAR(200), email VARCHAR(200),"
                        "id_usuario INTEGER,  tipo_entrega VARCHAR(100),"
                        "forma_pg VARCHAR(100), cep VARCHAR(100),"
                        "rua VARCHAR(200), num INTEGER, bairro VARCHAR(200), municipio VARCHAR(200), "
                        "uf VARCHAR(2), referencia VARCHAR(200), status VARCHAR(50),"
                        "finalizar_pedido VARCHAR(30),nome_fun VARCHAR(40),"
                        "id_produto INTEGER,produto VARCHAR(200), medida VARCHAR(40), total_pg NUMERIC, quant INTEGER," 
                        "data DATE DEFAULT CURRENT_DATE, hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
                        "FOREIGN KEY(id_produto) REFERENCES produtos);")
      con.commit()
      return jsonify("Criei as tabelas") 
    
    
    #   cursor.execute("CREATE TABLE IF NOT EXISTS pedidos(id_pedido serial PRIMARY KEY,"
    #                     "nome_cliente VARCHAR(40), email VARCHAR(40),"
    #                     "id_usuario INTEGER, tipo_entrega VARCHAR(40),forma_pg VARCHAR, cep VARCHAR(20),"
    #                     "rua VARCHAR(50), num INTEGER, bairro VARCHAR(40), municipio VARCHAR, uf VARCHAR(2), referencia VARCHAR,"
    #                     "status VARCHAR, finalizar_pedido VARCHAR(10),nome_fun VARCHAR(40),produto VARCHAR(40),"
    #                     "id_produto INTEGER,  quant INTEGER, medida VARCHAR(40), total_pg NUMERIC," 
    #                     " data_hora  TIMESTAMP DEFAULT CURRENT_TIMESTAMP, "
    #                     "FOREIGN KEY(id_produto) REFERENCES produtos);")  

    # Commit (salvar) as mudanças
    #   con.commit()
    #   return jsonify("Criei as tabelas") 

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
    
def atualizar_usuario(dados):
      cursor.execute("UPDATE usuarios SET nome = %s, email = %s, telefone = %s, cpf =%s, nivel = %s, senha = %s WHERE id_usuario =%s",
                              (dados["nome"], dados["email"], dados["telefone"], dados["cpf"], dados["nivel"],generate_password_hash(dados["senha"]), dados["id_usuario"]))
      con.commit()
      return jsonify({"message": "Atualizado com sucesso.", "dados": dados}), 200 

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
        return jsonify({"message": "Erro ao excluir o usuário.", "error": str(e)}), 500
    
    finally:
        if con:
            pass

def listar_usuarios():
       cursor.execute("SELECT * FROM usuarios ORDER BY id_usuario ASC")
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

    cursor.execute("SELECT * FROM usuarios WHERE email = %s ORDER BY id_usuario ASC", (email,))
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
            # refresh_token = create_access_token(identity=email)
            vetor.append(chaves)

    if vetor:
        return jsonify({"dados":vetor, "token": access_token})
        # return jsonify({"dados":vetor, "token": access_token, "refresh_token":refresh_token})
    else:
        return jsonify({'message': 'Credenciais inválidas'}), 401


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
    
    except psycopg2.IntegrityError as e:
         con.rollback()
         return jsonify({"message": "O dado que você selecionou está integrado a outras tabelas.", "error": str(e)}), 500

    except Exception as e:
        con.rollback()
        return jsonify({"message": "Erro ao excluir.", "error": str(e)}), 500
    
    finally:
        if con:
             pass
            # con.close()

def listar_categorias():
       cursor.execute("SELECT * FROM categorias;")
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
                        (dados["nome"],  dados["id_categoria"], dados["unidade_medida"], dados["valor"]))
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
    
    except psycopg2.IntegrityError as e:
         con.rollback()
         return jsonify({"message": "O dado que você selecionou está integrado a outras tabelas.", "error": str(e)}), 500

    except Exception as e:
        con.rollback()
        return jsonify({"message": "Erro ao excluir.", "error": str(e)}), 500
    
    finally:
        if con:
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

def listar_categoria_produto(id_categoria):
       cursor.execute("SELECT * FROM produtos WHERE  id_categoria=\'{}\'".format(id_categoria))
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_produto": resultado[0], "nome": resultado[1], "id_categoria": resultado[2], "unidade_medida":resultado[3], "valor":resultado[4]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor) 

#operações de pedidos

# def inserir_pedido(dados): 

#       cursor.execute("INSERT INTO pedidos (nome_cliente, email, id_produto, id_usuario, medida,"
#                      "tipo_entrega, forma_pg, total_pg, cep, rua, num, bairro, municipio, uf, referencia,"
#                      "produto, status, finalizar_pedido, nome_fun, quant) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);",
#                      (dados["nome_cliente"], dados["email"], dados["id_produto"], dados["id_usuario"],
#                       dados["medida"], dados["tipo_entrega"], dados["forma_pg"], dados["total_pg"],
#                       dados["cep"], dados["rua"], dados["num"], dados["bairro"], dados["municipio"],
#                       dados["uf"], dados["referencia"], dados["produto"], dados["status"], dados["finalizar_pedido"],
#                       dados["nome_fun"],dados["quant"]))
#       con.commit()
#       return jsonify({"message": "Pedido cadastrado com sucesso."}), 201

def inserir_pedido(dados): 

        nome_cliente = dados["nome_cliente"]
        email = dados["email"]
        id_usuario = dados["id_usuario"]
        tipo_entrega = dados["tipo_entrega"]
        forma_pg = dados["forma_pg"]
        cep = dados["cep"]
        rua = dados["rua"]
        num = dados["num"]
        bairro = dados["bairro"]
        municipio = dados["municipio"]
        uf = dados["uf"]
        referencia = dados["referencia"]
        status = dados["status"]
        finalizar_pedido = dados["finalizar_pedido"]
        nome_fun = dados["nome_fun"]
        
        produtos = dados["produtos"]
        
        for produto in produtos:
         cursor.execute("INSERT INTO pedidos (nome_cliente, email, id_usuario,"
                    "tipo_entrega, forma_pg, cep, rua, num, bairro, municipio, uf, referencia, status,"
                    "finalizar_pedido, nome_fun, id_produto, produto, medida, total_pg, quant)"
                    "VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);",
                    (nome_cliente,  email, id_usuario, tipo_entrega,
                    forma_pg, cep, rua, num, bairro, municipio,
                    uf, referencia, status, finalizar_pedido,nome_fun,
                    produto["id_produto"], produto["produto"], produto["medida"],
                    produto["total_pg"], produto["quant"]))
        con.commit()
        return jsonify({"message": "Pedido cadastrado com sucesso."}), 201
    
 #atualizar tem que refazer
def atualizar_pedido(dados):
      cursor.execute("UPDATE pedidos SET nome_cliente = %s, email = %s, id_usuario = %s, tipo_entrega = %s, forma_pg = %s,"
                    "cep = %s, rua = %s, num = %s, bairro = %s, municipio = %s, uf = %s, referencia = %s, status = %s," 
                    "finalizar_pedido = %s, nome_fun = %s, id_produto = %s, produto = %s, medida = %s, total_pg = %s, quant = %s WHERE id_pedido =%s",
                    (dados["nome_cliente"], dados["email"], dados["id_usuario"], dados["tipo_entrega"],
                    dados["forma_pg"], dados["cep"], dados["rua"], dados["num"],
                    dados["bairro"], dados["municipio"], dados["uf"], dados["referencia"], dados["status"],
                    dados["finalizar_pedido"], dados["nome_fun"], dados["id_produto"], dados["produto"], dados["medida"],
                    dados["total_pg"], dados["quant"], dados["id_pedido"]))      
      con.commit()
      return jsonify({"message": "Pedido atualizado com sucesso.", "data": dados}), 200 

def deletar_pedido(id_pedido):
    try:
        cursor.execute("DELETE FROM pedidos WHERE id_pedido=\'{}\'".format(id_pedido))
        con.commit()

        return jsonify({"message": "Pedidos excluído com sucesso."}), 200
    
    
    except psycopg2.IntegrityError as e:
         con.rollback()
         return jsonify({"message": "O dado que você selecionou está integrado a outras tabelas.", "error": str(e)}), 500

    except Exception as e:
        con.rollback()
        return jsonify({"message": "Erro ao excluir.", "error": str(e)}), 500
    
    finally:
        if con:
            pass

def listar_pedidos():
       cursor.execute("SELECT * FROM pedidos ORDER BY id_pedido ASC")
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_pedido": resultado[0], "nome_cliente": resultado[1], "email": resultado[2],
                     "id_usuario":resultado[3], "tipo_entrega":resultado[4],"forma_pg":resultado[5], 
                     "cep":resultado[6], "rua":resultado[7], "num":resultado[8],
                     "bairro":resultado[9], "municipio":resultado[10], "uf":resultado[11],"referencia":resultado[12],
                     "status":resultado[13], "finalizar_pedido":resultado[14], "nome_fun":resultado[15], "id_produto":resultado[16],
                     "produto":resultado[17], "medida":resultado[18], "total_pg":resultado[19], "quant":resultado[20], "data":resultado[21],'hora':resultado[22]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor)  

def listar_pedido(id_pedido):
       cursor.execute("SELECT * FROM pedidos WHERE  id_pedido=\'{}\' ORDER BY id_pedido ASC".format(id_pedido))
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_pedido": resultado[0], "nome_cliente": resultado[1], "email": resultado[2],
                     "id_usuario":resultado[3], "tipo_entrega":resultado[4],"forma_pg":resultado[5], 
                     "cep":resultado[6], "rua":resultado[7], "num":resultado[8],
                     "bairro":resultado[9], "municipio":resultado[10], "uf":resultado[11],"referencia":resultado[12],
                     "status":resultado[13], "finalizar_pedido":resultado[14], "nome_fun":resultado[15], "id_produto":resultado[16],
                     "produto":resultado[17], "medida":resultado[18], "total_pg":resultado[19], "quant":resultado[20], "data":resultado[21], "hora":resultado[22]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor)  

def listar_pedido_usuario(email):
       cursor.execute("SELECT * FROM pedidos WHERE  email=\'{}\' ORDER BY id_pedido ASC".format(email))
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_pedido": resultado[0], "nome_cliente": resultado[1], "email": resultado[2],
                     "id_usuario":resultado[3], "tipo_entrega":resultado[4],"forma_pg":resultado[5], 
                     "cep":resultado[6], "rua":resultado[7], "num":resultado[8],
                     "bairro":resultado[9], "municipio":resultado[10], "uf":resultado[11],"referencia":resultado[12],
                     "status":resultado[13], "finalizar_pedido":resultado[14], "nome_fun":resultado[15], "id_produto":resultado[16],
                     "produto":resultado[17], "medida":resultado[18], "total_pg":resultado[19], "quant":resultado[20], "data":resultado[21],"hora":resultado[22]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor)
       
def listar_pedidos_finalizados():
       cursor.execute("SELECT * FROM pedidos WHERE finalizar_pedido='Finalizado' ORDER BY id_pedido ASC")
       linhas = cursor.fetchall()
       vetor = []
       chaves = {}
       for resultado in linhas:
          chaves = {"id_pedido": resultado[0], "nome_cliente": resultado[1], "email": resultado[2],
                     "id_usuario":resultado[3], "tipo_entrega":resultado[4],"forma_pg":resultado[5], 
                     "cep":resultado[6], "rua":resultado[7], "num":resultado[8],
                     "bairro":resultado[9], "municipio":resultado[10], "uf":resultado[11],"referencia":resultado[12],
                     "status":resultado[13], "finalizar_pedido":resultado[14], "nome_fun":resultado[15], "id_produto":resultado[16],
                     "produto":resultado[17], "medida":resultado[18], "total_pg":resultado[19], "quant":resultado[20], "data":resultado[21], "hora":resultado[22]} 
          vetor.append(chaves) 
                  # chaves = {}  
       return jsonify(vetor) 
   
def procurar_pedidos_por_data(dados):

            # data = datetime.strptime(dados, "%a, %d %b %Y %H:%M:%S")
            cursor.execute("SELECT * FROM pedidos WHERE data= %s AND finalizar_pedido='Finalizado' ORDER BY id_pedido ASC", (dados,))
            linhas = cursor.fetchall()
            vetor = []
            chaves = {}
            for resultado in linhas:
                chaves = {"id_pedido": resultado[0], "nome_cliente": resultado[1], "email": resultado[2],
                        "id_usuario":resultado[3], "tipo_entrega":resultado[4],"forma_pg":resultado[5], 
                        "cep":resultado[6], "rua":resultado[7], "num":resultado[8],
                        "bairro":resultado[9], "municipio":resultado[10], "uf":resultado[11],"referencia":resultado[12],
                        "status":resultado[13], "finalizar_pedido":resultado[14], "nome_fun":resultado[15], "id_produto":resultado[16],
                        "produto":resultado[17], "medida":resultado[18], "total_pg":resultado[19], "quant":resultado[20], "data":resultado[21], "hora":resultado[22]} 
                vetor.append(chaves) 
            return jsonify(vetor)

def enviar_email(dados):  
    corpo_email = f"""
    <p><b>Olá, {dados['nome']}</b></p>
    <p> Mensagem:{dados['mensagem']} <p>
    """

    msg = email.message.Message()
    msg['Subject'] = "Seu Pedido - Pizzaria Marques"
    msg['From'] = 'testedsc60@gmail.com'
    msg['To'] = dados['email']
    password = 'cfkkitwtwhqdnxrx' 
    msg.add_header('Content-Type', 'text/html')
    msg.set_payload(corpo_email )

    s = smtplib.SMTP('smtp.gmail.com: 587')
    s.starttls()
    # Login Credentials for sending the mail
    s.login(msg['From'], password)
    s.sendmail(msg['From'], [msg['To']], msg.as_string().encode('utf-8'))
    return('Email enviado')

       
def fechar_conexao():
      con.close()