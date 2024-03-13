# Laravel API Cooperado

Este é um projeto Laravel para uma API de cooperados.

## Pré-requisitos

Antes de começar, certifique-se de ter instalado em sua máquina:

- PHP (versão recomendada: 7.4 ou superior)
- Composer (gerenciador de dependências do PHP)
- Docker (para usar ambiente Dockerizado)

## Instalação

Clone o repositório:
git clone https://github.com/jojesd/laravelapi-cooperado.git

Configure o arquivo .env com suas informações de banco de dados. Você pode copiar o arquivo .env.example e renomeá-lo para .env:

cp .env.example .env
E então, edite o arquivo .env conforme necessário.

execute o composer install para instalar dependencias

execute o docker-compose up --build
para subir os containers 

execute as migrações do banco de dados para criar as tabelas necessárias:
docker-compose exec app php artisan migrate


Você poderá acessar a API em http://localhost:8000/api/{rota}.


