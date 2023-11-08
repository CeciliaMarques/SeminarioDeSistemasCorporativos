import os
from app import app

if __name__ =='main':

    porta = int(os.getenv('PORT'), '3000')
    app.run(host='0.0.0.0', port=porta)

    #Pega a porta que o servidor está rodando se não tiver nenhuma setada use a porta 5000
    #variavel PORT é a variavel de ambiente port
    
    #(import os) importa uma biblioteca do Python  que tem acesso ao sistema operacional para pegar as informações da porta
    #executa a API metódo main