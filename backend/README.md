### System LaraVue

Projeto LaraVue desenvolvido em Laravel + Vue

Siga os passos abaixo para instalar e rodar apenas o backend.

#### Frameworks e Bibliotecas

-   <a href="https://packagist.org/packages/php-open-source-saver/jwt-auth" target="_blank">JWT</a>
-   <a href="https://laravel.com/" target="_blank">Laravel 9</a>
-   `Banco de dados SQLite`

#### Instalação

-   `composer install`

#### Para rodar o projeto

-   `php artisan migrate:fresh`
-   `php artisan serve`

#### Endpoints BACKEND

-   `(POST) /login - logar no sistema - parâmetros: {email, password}`
-   `(POST) /register - cadastrar no sistema - parâmetros: {name, email, password, password_confirmation}`

##### Os endpoints abaixo necessitam de autenticação:

Obs: Ao fazer login, o usuário recebe um token que é utilizado para autenticar as requisições futuras, basta enviar o token no cabeçalho da requisição útilizando o header `Authorization: Bearer {token}`

-   `(POST) /logout - sair do sistema`
-   `(GET) /user - pegar dados do usuário autenticado`
-   `(PUT) /user - atualizar dados do usuário autenticado - parâmetros opcionais: {name, email, password, password_confirmation}`
-   `(GET) /product/{id} - listar apenas um produto`
-   `(GET) /products - listar todos os produtos`
-   `(POST) /products - cadastrar um produto - parâmetros: {name, description, price}`
-   `(PUT) /product/{id} - atualizar um produto - parâmetros: {name, description, price}`
-   `(DELETE) /product/{id} - deletar um produto`

Obs: para o projeto funcionar perfeitamente o backend deve rodar em conjunto com o frontend.
