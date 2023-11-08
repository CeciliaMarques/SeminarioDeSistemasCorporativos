
FROM postgres
ENV POSTGRES_USER postgres
ENV POSTGRES_PASSWORD 12345
ENV POSTGRES_DB bancoDsc

# Copie arquivos de configuração personalizados para o contêiner
COPY postgresql.conf /etc/postgresql/postgresql.conf
COPY pg_hba.conf /etc/postgresql/pg_hba.conf
RUN service postgresql restart
VOLUME /banco/
EXPOSE 5432
CMD ["postgres"]
