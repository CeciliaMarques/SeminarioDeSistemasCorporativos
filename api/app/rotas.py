from flask import Flask, request
from app import app
from app import conexao

#Quando o sistema estiver com todas as dependenias gerar outro arquivo requirements.txt

@app.route("/")
def index():
    return "Olá Mundo!!!"

@app.route("/criar/tabelas")
def criar_tabelas():
    con = conexao
    resposta= con.criar_tabelas()
    return resposta

@app.route("/inserir/usuario",  methods=['POST'])
def inserir_usuario():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.inserir_usuario(dados)
    return resposta

@app.route('/atualizar/usuario',methods=['PUT'])
def atualizar_usuario():    
    con  = conexao
    dados = request.get_json(force=True)
    resposta = con.atualizar_usuario(dados)
    return resposta

@app.route('/deletar/usuario/<id_usuario>',methods=['DELETE'])
def deletar_usuario(id_usuario):    
    con  = conexao
    resposta = con.deletar_usuario(id_usuario)
    return resposta
