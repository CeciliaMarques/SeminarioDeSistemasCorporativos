from flask import Flask, request
from app import app
from app import conexao

#Quando o sistema estiver com todas as dependenias gerar outro arquivo requirements.txt

@app.route("/")
def index():
    return "Olá Mundo!!!"