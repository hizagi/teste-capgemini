# Teste Capgemini

O projetoconsiste em uma aplicação que possibilita as oprações de saque e deposito em uma conta, onde é possível também visualizar o saldo dessa conta.
O backend foi desenvolvido em **[Laravel](https://laravel.com/) ([PHP](https://www.php.net/))** [REST](https://www.w3.org/2001/sw/wiki/REST) e frontend em **[Vue.js](https://vuejs.org/)** com **[Bootstrap 4](https://getbootstrap.com/docs/4.0/getting-started/introduction/)**. A autenticação é feita via **[JWT](https://jwt.io/)**.

## Estrutura do projeto entregue neste repositório

- Servidor backend rodando na porta **8000 (API)** e servidor de desenvolvimento frontend rodando na porta **8080 (frontend)**.

### Diretórios do projeto

- **[backend](https://github.com/hizagi/teste-capgemini/tree/master/backend)**: arquivos do projeto backend.

  - **[database](https://github.com/hizagi/teste-capgemini/tree/master/backend/database)**: onde estão localizadas as migrations, seeds e o banco SQLite utilizado.
  - **[routes](https://github.com/hizagi/teste-capgemini/blob/master/backend/routes/api.php)**: onde estão localizadas as rotas.
  - **[app](https://github.com/hizagi/teste-capgemini/tree/master/backend/app)**
    - **[Http](https://github.com/hizagi/teste-capgemini/tree/master/backend/app/Http)**
      - **[Controllers](https://github.com/hizagi/teste-capgemini/tree/master/backend/app/Http)**: onde estão localizados os controllers, responsaveis pela validação e formatação dos dados.
      - **[Requests](https://github.com/hizagi/teste-capgemini/tree/master/backend/app/Http)**: onde estão localizadas as regras de validação de cada requisição que os controllers recebem.
    - **[Models](https://github.com/hizagi/teste-capgemini/tree/master/backend/app/Http)**: onde estão localizados os models do projeto, são os mapeamentos dos atributos das tabelas do banco e suas relações.
    - **[Observers](https://github.com/hizagi/teste-capgemini/tree/master/backend/app/Http)**: onde estão localizados os observadores de eventos dos models.
    - **[Services](https://github.com/hizagi/teste-capgemini/tree/master/backend/app/Http)**: onde estão os services, são os responsaveis por gerir as regras de negócio da aplicação.

- **[frontend](https://github.com/hizagi/teste-capgemini/tree/master/front-end)**: arquivos do projeto frontend.
  - **[src](https://github.com/hizagi/teste-capgemini/tree/master/front-end/src)**
    - **[components](https://github.com/hizagi/teste-capgemini/tree/master/front-end/src/components)**: onde estão localizados os componentes gerais do projeto que são utilizados em múltiplas páginas.
    - **[plugins](https://github.com/hizagi/teste-capgemini/tree/master/front-end/src/plugins)**: onde estão localizadas funções auxiliares adicionadas ao objeto Vue do projeto.
    - **[utils](https://github.com/hizagi/teste-capgemini/tree/master/front-end/src/utils)**: onde estão localizados arquivos auxiliares para o projeto em geral (ex: funções de formatação, enums, dicionarios).
    - **[views](https://github.com/hizagi/teste-capgemini/tree/master/front-end/src/views)**: onde estão localizadas as páginas da aplicação.
    - **[api.js](https://github.com/hizagi/teste-capgemini/blob/master/front-end/src/api.js)**: onde esta definido objeto singleton responsável pela comunicação via HTTP com o backend.
    - **[constants.js](https://github.com/hizagi/teste-capgemini/blob/master/front-end/src/constants.js)**: onde esta definidas constantes utilizadas globalmente no projeto.
    - **[router.js](https://github.com/hizagi/teste-capgemini/blob/master/front-end/src/router.js)**: onde as rotas e validações de navegação são definidas.
    - **[store.js](https://github.com/hizagi/teste-capgemini/blob/master/front-end/src/store.js)**: onde a store de gerenciamento de estado do Vuex é definida.

## Como executar o projeto?

### Pré-requisitos para testes

- git
- composer
- npm

### Executando o projeto

Clone o projeto:

```
git clone https://github.com/hizagi/teste-capgemini.git
```

Vá até a raiz do diretório clonado:

```
cd teste-capgemini
```

Acesse a pasta do backend:

```
cd backend
```

Execute a instalação das dependencias:

```
composer install
```

Após a instalação, inicie o servidor de desenvolvimento:

```
php artisan server
```

Obs: não é necessário definir o caminho do arquivo SQLite no env, pois fixei no arquivo de configuração.

Após isso, abra um novo terminal e vá até a pasta do frontend:

```
cd teste-capgemini/frontend
```

Instale as dependências:

```
npm i
```

Após a instalação, execute o servidor nodejs de desenvolvimento

```
npm run dev
```

Feito isso, o projeto estará pronto para uso.

### Para testar utilize

- API Laravel: [http://localhost:8000](http://localhost:8000/)
- Frontend Vue.js: [http://localhost:8080](http://localhost:8080/)

#### Usuário para autenticação

- E-mail: user@mail.com
- Senha: 123456

## Sobre o autor

> [João Vitor Oliveira Ferraz Silva](https://www.linkedin.com/in/jo%C3%A3o-vitor-oliveira-ferraz-silva-502b0213a/)
>
> [@hizagi](https://github.com/hizagi)
>
> [jvitor.ferraz14@gmail.com](mailto:jvitor.ferraz14@gmail.com)
