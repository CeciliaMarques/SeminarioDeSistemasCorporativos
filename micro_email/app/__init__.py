from flask import Flask
from flask_jwt_extended import JWTManager

app = Flask(__name__)
app.config['JWT_SECRET_KEY'] = 'sua-chave-secreta'
# Configuração para permitir o uso de tokens JWT em cabeçalhos
app.config['JWT_TOKEN_LOCATION'] = ['headers']
jwt = JWTManager(app)
from app import rotas