from flask import Flask, jsonify
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
