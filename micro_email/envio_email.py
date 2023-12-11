import os
from app import app

if __name__ =='main':

    porta = int(os.getenv('PORT'), '4000')
    app.run(host='0.0.0.0', port=porta)