from flask import Flask, request, jsonify
from app import app
from app import conexao
from flask_jwt_extended import jwt_required, get_jwt_identity


#Quando o sistema estiver com todas as dependenias gerar outro arquivo requirements.txt

@app.route("/")
def index():
    return "Olá Mundo!!!"

@app.route("/criar/tabelas")
def criar_tabelas():
    con = conexao
    resposta= con.criar_tabelas()
    return resposta

########## Rotas  de Usuários ##########
@app.route("/inserir/usuario",  methods=['POST'])
# @jwt_required()
def inserir_usuario():  
    #current_user = get_jwt_identity()  
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.inserir_usuario(dados)
    #return jsonify({'message': f'Hello, {current_user}'})
    return resposta

@app.route("/atualizar/usuario",methods=["PUT"])
@jwt_required()
def atualizar_usuario():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.atualizar_usuario(dados)
    return resposta

@app.route("/listar/usuarios",methods=["GET"])
@jwt_required()
def listar_usuarios():    
    con  = conexao
    resposta = con.listar_usuarios()
    return resposta

@app.route("/listar/usuario/<id_usuario>",methods=["GET"])
@jwt_required()
def listar_usuario(id_usuario):    
    con  = conexao
    resposta = con.listar_usuario(id_usuario)
    return resposta

@app.route("/deletar/usuario/<id_usuario>",methods=["DELETE"])
@jwt_required()
def deletar_usuario(id_usuario):    
    con  = conexao
    resposta = con.deletar_usuario(id_usuario)
    return resposta

########## Rotas  de Categorias ##########
@app.route("/inserir/categoria",  methods=['POST'])
@jwt_required()
def inserir_categoria():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.inserir_categoria(dados)
    return dados

@app.route("/atualizar/categoria",methods=["PUT"])
@jwt_required()
def atualizar_categoria():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.atualizar_categoria(dados)
    return resposta

@app.route("/listar/categorias",methods=["GET"])
def listar_categorias():    
    con  = conexao
    resposta = con.listar_categorias()
    return resposta

@app.route("/listar/categoria/<id_categoria>",methods=["GET"])
def listar_categoria(id_categoria):    
    con  = conexao
    resposta = con.listar_categoria(id_categoria)
    return resposta

@app.route("/deletar/categoria/<id_categoria>",methods=["DELETE"])
@jwt_required()
def deletar_categoria(id_categoria):    
    con  = conexao
    resposta = con.deletar_categoria(id_categoria)
    return resposta

########## Rotas  de Produtos ##########
@app.route("/inserir/produto",  methods=['POST'])
@jwt_required()
def inserir_produto():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.inserir_produto(dados)
    return resposta

@app.route("/atualizar/produto",methods=["PUT"])
@jwt_required()
def atualizar_produto():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.atualizar_produto(dados)
    return resposta

@app.route("/listar/produtos",methods=["GET"])
def listar_produtos():    
    con  = conexao
    resposta = con.listar_produtos()
    return resposta

@app.route("/listar/produto/<id_produto>",methods=["GET"])
def listar_produto(id_produto):    
    con  = conexao
    resposta = con.listar_produto(id_produto)
    return resposta

@app.route("/listar/categoria/produtos/<id_categoria>",methods=["GET"])
def listar_categoria_produto(id_categoria):    
    con  = conexao
    resposta = con.listar_categoria_produto(id_categoria)
    return resposta

@app.route("/deletar/produto/<id_produto>",methods=["DELETE"])
@jwt_required()
def deletar_produto(id_produto):    
    con  = conexao
    resposta = con.deletar_produto(id_produto)
    return resposta

########## Rotas  de Pedidos ##########
@app.route("/inserir/pedido",methods=['POST'])
def inserir_pedido():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.inserir_pedido(dados)
    return resposta

@app.route("/atualizar/pedido",methods=["PUT"])
def atualizar_pedido():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.atualizar_pedido(dados)
    return resposta

@app.route("/listar/pedidos",methods=["GET"])
def listar_pedidos():    
    con  = conexao
    resposta = con.listar_pedidos()
    return resposta

@app.route("/listar/pedido/usuario/<email>",methods=["GET"])
def listar_pedido_usuario(email):    
    con  = conexao
    resposta = con.listar_pedido_usuario(email)
    return resposta
@app.route("/listar/pedido/<id_pedido>",methods=["GET"])
def listar_pedido(id_pedido):    
    con  = conexao
    resposta = con.listar_pedido(id_pedido)
    return resposta

@app.route("/listar/pedidos/finalizados",methods=["GET"])
def listar_pedido_finalizados():    
    con  = conexao
    resposta = con.listar_pedidos_finalizados()
    return resposta

@app.route("/procurar/pedidos",methods=["POST"])
def procurar_pedidos_por_data():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.procurar_pedidos_por_data(dados)
    return resposta

@app.route("/deletar/pedido/<id_pedido>",methods=["DELETE"])
def deletar_pedido(id_pedido):    
    con  = conexao
    resposta = con.deletar_pedido(id_pedido)
    return resposta

########## Rotas  de sistema ##########
@app.route("/login",  methods=['POST'])
def login():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.logar(dados)
    return resposta
@app.route("/enviar/email",  methods=['POST'])
def enviar_email():    
    dados = request.get_json(force=True)
    resposta = conexao.enviar_email(dados)
    return resposta