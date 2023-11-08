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

########## Rotas  de sistema ##########
@app.route("/login",  methods=['POST'])
def login():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.logar(dados)
    return resposta