# Clone o projeto
  git clone https://github.com/pauloflausino/php-rest

# Entre na pasta do projeto
    cd c:\php-rest

# Execute o server php 
    php -S 127.0.0.1:8080

# Banco de dados
    dump-phpapidb-202305221533.sql


# php-rest
API REST, para uma aplicação de gerenciamento
recursos financeiros de clubes.

## PHP Endpoints
* `GET - http://localhost:8080/api/club/read.php` Fetch ALL Records
* `GET - http://localhost:8080/api/resource/read.php` Fetch ALL Records
* `POST - http://localhost:8080/api/club/create.php` Create Club Record
* `POST - http://localhost:8080/api/resource/create.php` Create Resource Record
* `POST - http://localhost:8080/api/consume/create.php` Create Consume Record
