from flask import Flask, request, jsonify
from app import app
from flask_jwt_extended import jwt_required, get_jwt_identity
from app import app, email

########## Rotas  de email ##########
@app.route("/enviar/email",  methods=['POST'])
def enviar_email():    
    dados = request.get_json(force=True)
    resposta = email.enviar_email(dados)
    return resposta


