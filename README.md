# User API Laravel

Trata-se de uma API desenvolvida utilizando as tecnologias do PHP 8, cujo o objetivo é interagir com usuários, endereços, estados e cidades armazenados em banco de dados. O projeto aborda uma maneira fácil porém consistente de organizar uma aplicação por MVC (Model, View, Controller) no PHP nativo, distribuindo blocos de código em endpoints voltados para API seguindo a lógica do CRUD. Por se tratar de uma API, foram definidos alguns endpoints para facilitar as requisições

## Endpoints

### Users (Usuários)
- `GET /api/users/:id`: Obtém registros de usuários ou através do id
- `POST /api/users`: Insere um registro de usuário
- `PUT /api/users/:id`: Atualiza um registro de usuário através do id
- `DELETE /api/users/:id`: Remove um registro de usuário através do id

### States (Estados)
- `GET /api/states/:id`: Obtém registros de Estados ou através do id
- `POST /api/states`: Insere um registro de Estado
- `PUT /api/states/:id`: Atualiza um registro de Estado através do id
- `DELETE /api/states/:id`: Remove um registro de Estado através do id

### Cities (Cidades)
- `GET /api/city/:id`: Obtém registros de Cidades ou através do id
- `POST /api/city`: Insere um registro de Cidade
- `PUT /api/city/:id`: Atualiza um registro de Cidade através do id
- `DELETE /api/city/:id`: Remove um registro de Cidade através do id

### Streets (Ruas)
- `GET /api/street/:id`: Obtém registros de Ruas ou através do id
- `POST /api/street`: Insere um registro de Rua
- `PUT /api/street/:id`: Atualiza um registro de Rua através do id
- `DELETE /api/street/:id`: Remove um registro de Rua através do id

### Address (Endereços)
- `GET /api/address/:id`: Obtém registros de Endereços ou através do id
- `POST /api/address`: Insere um registro de Endereço
- `PUT /api/address/:id`: Atualiza um registro de Endereço através do id
- `DELETE /api/address/:id`: Remove um registro de Endereço através do id

Os endpoints acima são utilizados de acordo com os métodos de requisição especificados no início de sua descrição. Recomendo utilizar o Client API <a href="https://www.postman.com"/>Postman</a> para a melhor modelagem e aproveitamento das requisições. 

## Banco de Dados

Para esse projeto foi utilizado o banco de dados MySQL 8, tendo sua estrutura de tabelas organizada da seguinte forma:

- users:
  - id | PRIMARY KEY
  - first_name
  - last_name
  - phone_number
  - email
  - password
  - created_at | TIMESTAMP
  - updated_at | TIMESTAMP
 
- states:
  - id | PRIMARY KEY
  - name
  - uf
  - created_at | TIMESTAMP
  - updated_at | TIMESTAMP

- cities:
  - id | PRIMARY KEY
  - name
  - state_id | FOREIGN_KEY | states:id
  - created_at | TIMESTAMP
  - updated_at | TIMESTAMP
 
- streets:
  - id | PRIMARY KEY
  - name
  - state_id | FOREIGN_KEY | cities:id
  - created_at | TIMESTAMP
  - updated_at | TIMESTAMP
 
- addresses:
  - id | PRIMARY KEY
  - name
  - user_id | FOREIGN_KEY | users:id
  - state_id | FOREIGN_KEY | states:id
  - city_id | FOREIGN_KEY | cities:id
  - street_id | FOREIGN_KEY | streets:id
  - created_at | TIMESTAMP
  - updated_at | TIMESTAMP
 

## Pré requisitos

Para rodar esta aplicação foram utilizadas as seguintes tecnologias:

    PHP 8.3.2
    MySQL 8.0.32 Community Server
    NGINX
    GIT
    Docker 25.0.2

