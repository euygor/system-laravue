### System LaraVue

Projeto LaraVue desenvolvido em Laravel + Vue

#### Frameworks e Bibliotecas

- <a href="https://packagist.org/packages/php-open-source-saver/jwt-auth" target="_blank">JWT</a>
- <a href="https://axios-http.com/ptbr/docs/intro" target="_blank">Axios</a>
- <a href="https://lodash.com/" target="_blank">Lodash</a>
- <a href="https://getbootstrap.com/" target="_blank">Bootstrap 5</a>
- <a href="https://vuejs.org/" target="_blank">Vue 3</a>
- <a href="https://laravel.com/" target="_blank">Laravel 9</a>
- `Banco de dados SQLite`

O projeto está totalmente configurado basta seguir os passos abaixo para instalar e rodar o frontend e o backend juntos.

#### Instalação

- `npm run dependences`

#### Para rodar o projeto

- `npm run dev`

#### Rotas FRONTEND

- `/login - logar no sistema`
- `/register - cadastrar no sistema`

##### As rotas abaixo necessitam de autenticação:

- `/logout - sair do sistema`
- `/ - home do sistema`
- `/my-account - perfil do usuário`

#### Endpoints BACKEND

- `(POST) /login - logar no sistema - parâmetros: {email, password}`
- `(POST) /register - cadastrar no sistema - parâmetros: {name, email, password, password_confirmation}`

##### Os endpoints abaixo necessitam de autenticação:

Obs: Ao fazer login, o usuário recebe um token que é utilizado para autenticar as requisições futuras, basta enviar o token no cabeçalho da requisição útilizando o header `Authorization: Bearer {token}`

- `(POST) /logout - sair do sistema`
- `(GET) /user - pegar dados do usuário autenticado`
- `(PUT) /user - atualizar dados do usuário autenticado - parâmetros opcionais: {name, email, password, password_confirmation}`
- `(GET) /product/{id} - listar apenas um produto`
- `(GET) /products - listar todos os produtos`
- `(POST) /products - cadastrar um produto - parâmetros: {name, description, price}`
- `(PUT) /product/{id} - atualizar um produto - parâmetros: {name, description, price}`
- `(DELETE) /product/{id} - deletar um produto`

Obs: para o projeto funcionar perfeitamente siga os passos acima.
