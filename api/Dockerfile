FROM python:3.11

# execute dentro dessa pasta /app
WORKDIR /app


VOLUME ./back
COPY requirements.txt .
# # Instale as dependências do Python
RUN pip install --no-cache-dir -r requirements.txt

# Install Flask, jsonify, and psycopg2 using pip
RUN pip install Flask jsonify psycopg2  virtualenv
# Copi para /app
COPY ./  /app

# porta 5000
EXPOSE 5000
ENV FLASK_APP=api.py
ENV FLASK_ENV=development
ENV FLASK_DEBUG=1

# executa a aplicação
CMD ["flask", "run", "--host=0.0.0.0"]



