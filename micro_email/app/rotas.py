from flask import Flask, request, jsonify
from app import app
from flask_jwt_extended import jwt_required, get_jwt_identity


@app.route("/")
def index():
    return "Olá Mundo!!!"