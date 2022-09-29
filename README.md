Projeto de API Restful utilizando Laravel8, utilizando infra própria montada no Docker. A API foi feita para criação de Playlists. Cada Playlist possui um título, uma descrição e o nome do autor, além de poder ter uma lista de conteúdos. Cada conteúdo possui um título, uma url e o nome do autor.

A estrutura das pastas é a seguinte:

- apache - Contém o arquivo de configuração do servidor web utilizado para rodar o Laravel.
- app - Pasta que contém o projeto a ser executado, nesse caso, o Laravel.
- db - Contém o Dockerfile referente ao container do banco de dados. Nesse projeto foi utilizado o MySQL.
- php - Contém o Dockerfile referente ao container do servidor web. Esta estrutura usa o apache.
- postman - Embora não seja utilizado, o projeto está preparado para ter um container do postman, biblioteca utilizada para testes da API. Recomenda-se a utilização do postman com GUI rodando no host, uma vez que a porta do servidor web é exposta ao host (porta 80).

Além das pastas, o docker-compose.yml está na raíz do projeto. Nesse arquivo é possível ver como o projeto foi estruturado no Docker. Toda a configuração das portas de uso (80 para o servidor web, 8080 para o SGBD phpmyadmin e 3306 para o db) é feita nesse arquivo. É necessário verificar se as portas não irão entrar em conflito por outros projetos que já estejam sendo executado no host. Também é possível alterar o nome dos containers nesse arquivo. É recomendado ter cuidado ao alterar esse arquivo, tanto no nome dos containers quanto nas portas, pois esses dados são utilizados em várias prates do sistema. Por exemplo, o laravel usa o nome do container do banco de dados (db) para conectar.

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

4 - Com a estrutura esteja montada, dentro do terminal, é necessário instalar os pacotes necessários para rodar o projeto:

```
composer install
```

5 - Na pasta do projeto Laravel (/app), gerar o arquivo .env (pode ser copiando o example: cp .env.example .env) e alterar essas linhas:

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=MYSQL_DATABASE
DB_USERNAME=MYSQL_USER
DB_PASSWORD=MYSQL_PASSWORD
```

6 - Ainda no terminal, gerar uma chave de segurança para o Laravel, limpar o cache das rotas e executar o migrate com seed para montar o banco e popular a tabela:

```
php artisan key:generate
php artisan route:cache
php artisan migrate
```

O projeto estará disponível na máquina host. A home do Laravel estará disponível em:

http://localhost/

A documentação da API, desenvolvida no Swagger, pode ser acessada em:

http://localhost/api/documentation

As rotas podem ser acessadas pelo Postman ou qualquer outra ferramenta de teste de API, através das rotas indicadas na documentação.

Os testes já montados para a API podem ser executados através do comando (novamente, através de um bash interativo no container do servidor web):
```
php artisan test
```

No caso de alteração na API, para refletir tais alterações na documentação, executar este comando dentro do terminal que acessa o projeto:
```
php artisan l5-swagger:generate
```

O projeto conta com arquivos de seed para popular o banco, caso o usuário queira testar a API sem inserir dados (ATENÇÃO: a versão inicial dos testes funciona apenas com o banco vazio, ao usar o seed, os testes não irão passar). A inserção é feita através do comando:
```
php artisan db:seed
```

Caso for aproveitar a estrutura, mas montar um projeto do zero, usar:
- docker-compose exec php-apache composer create-project laravel/laravel nome
- docker-compose exec php-apache chmod -R 777 storage
