Projeto de estudo para montar uma API no laravel8, utilizando infra montada no Docker

Para executar o projeto:

1 - Clonar o projeto e abrir a pasta.

(OPCIONAL) - Alterar o arquivo docker-compose.yml (Esse passo é opcional, necessário apenas se alguma das portas que os containers usam já estiver sendo utilizado por outra aplicação. Também é possível alterar o nome dos containers)

2 - Montar as imagens e os containers no Docker através do comando:

```
docker-compose up -d
```

ps: Se for no windows, pode necessário adicionar a pasta no "file sharing resources", mais dicas em: https://stackoverflow.com/questions/60754297/docker-compose-failed-to-build-filesharing-has-been-cancelled

3 - Abrir um terminal interativo com o container do servidor web para executar todos os comandos seguintes:

```
docker exec -it php-apache /bin/bash
```

4 - Uma vez que a estrutura esteja montada, instalar os pacotes necessários para rodar o projeto:

```
composer install
```

5 - Alterar o arquivo .env (pode ser copiando o example: cp .env.example .env) e alterar essas linhas:

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=MYSQL_DATABASE
DB_USERNAME=MYSQL_USER
DB_PASSWORD=MYSQL_PASSWORD
```

6 - Gerar uma chave de segurança para o Laravel, limpar o cache das rotas e executar o migrate com seed para montar o banco e popular a tabela:

```
php artisan key:generate
php artisan route:cache
php artisan migrate
```

O projeto estará disponível na máquina host, através do endereço:

http://localhost/

A home está em:

http://localhost/dashboard

Para acessar as páginas internas, é necessário realizar um cadastro, feito em:

http://localhost/register

Caso for aproveitar a estrutura, mas montar um projeto do zero, usar:
- docker-compose exec php-apache3 composer create-project laravel/laravel nome
- docker-compose exec php-apache3 chmod -R 777 storage
