from flask import Flask, jsonify, request
from flask_jwt_extended import create_access_token
import smtplib
import email.message

def enviar_email(dados):  
    corpo_email = f"""
    <p><b>Olá, {dados['nome']}</b></p>
    <p> Mensagem:{dados['mensagem']} <p>
    """

    msg = email.message.Message()
    msg['Subject'] = "Seu pedido saiu para a entrega - Pizzaria Marques"
    msg['From'] = 'testedsc60@gmail.com'
    msg['To'] = dados['email']
    password = '' 
    msg.add_header('Content-Type', 'text/html')
    msg.set_payload(corpo_email )

    s = smtplib.SMTP('smtp.gmail.com: 587')
    s.starttls()
    # Login Credentials for sending the mail
    s.login(msg['From'], password)
    s.sendmail(msg['From'], [msg['To']], msg.as_string().encode('utf-8'))
    print('Email enviado')
