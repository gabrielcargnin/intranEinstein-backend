# intranEinstein-backend
#Para rodar o projeto:

1 - Execute no terminal: "composer install" 
<br/>2 - No hostinger em MySQL Remoto, cria uma conexão de banco de dados remota, com host sendo o ip do seu computador e o banco de dados u198936323_dev
<br/>3 - no arquivo .env, troque a conexão pela seguinte: 
<br><b>
<br>DB_CONNECTION=mysql
<br>DB_HOST=sql49.main-hosting.eu
<br>DB_PORT=3306
<br>DB_DATABASE=u198936323_dev
<br>DB_USERNAME=u198936323_dev
<br>DB_PASSWORD=12345678</b>
<br><br>
4 - Para inicializar o servidor de testes, execute no terminal "php artisan serve"
