import os
from app import app

if __name__ =='main':

    port = int(os.getenv('PORT'), '5000')
    app.run(host='0.0.0.0', porta=port)

    #Pega a porta que o servidor está rodando se não tiver nenhuma setada use a porta 5000
    #variavel PORT é a variavel de ambiente port
    
    #(import os) importa uma biblioteca do Python  que tem acesso ao sistema operacional para pegar as informações da porta
    #executa a API metódo main