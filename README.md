# Cadastro de Clientes

Aplicação web desenvolvida em PHP com Laravel para cadastro e gerenciamento de clientes, utilizando PostgreSQL para persistência dos dados.

## Tecnologias utilizadas

- PHP 8.3
- Laravel 12
- PostgreSQL 17
- Docker e Docker Compose
- Blade para as páginas da aplicação

## Funcionalidades

- Listagem de clientes cadastrados.
- Cadastro de clientes com nome, e-mail, telefone e foto opcional.
- Edição dos dados de um cliente.
- Exclusão de clientes.
- Upload e exibição de fotos em miniatura.
- Validação dos campos do formulário.
- Persistência dos dados em banco de dados relacional.

## Requisitos

- Docker Desktop instalado e em execução.
- Git, caso queira clonar o repositório.

Não é necessário instalar PHP ou Composer diretamente na máquina.

## Como executar o projeto

### 1. Clonar o repositório

```bash
git clone URL_DO_REPOSITORIO
cd desafio-backend-php
```

Substitua `URL_DO_REPOSITORIO` pelo endereço do repositório.

### 2. Configurar o ambiente

Crie o arquivo `.env` do Laravel:

```bash
cp src/.env.example src/.env
```

### 3. Construir a imagem do PHP

Na raiz do projeto, execute:

```bash
docker compose build app
```

### 4. Instalar as dependências do Laravel

```bash
docker compose run --rm --no-deps app composer install
```

Esse comando instala as dependências do Composer na pasta `src/vendor`.

### 5. Iniciar os containers

```bash
docker compose up -d
```

### 6. Gerar a chave da aplicação

```bash
docker compose exec app php artisan key:generate
```

### 7. Criar as tabelas do banco de dados

```bash
docker compose exec app php artisan migrate
```

### 8. Configurar o armazenamento público das fotos

```bash
docker compose exec app php artisan storage:link
```

### 9. Acessar a aplicação

Abra no navegador:

http://localhost:8000

## Banco de dados

A tabela `clients` armazena os seguintes campos:

| Campo | Descrição |
|---|---|
| `id` | Identificador do cliente |
| `name` | Nome |
| `email` | E-mail único |
| `phone` | Telefone |
| `photo_path` | Caminho da foto, quando cadastrada |
| `created_at` | Data de criação |
| `updated_at` | Data da última atualização |

As fotos são armazenadas no disco público do Laravel, enquanto o banco de dados guarda o caminho do arquivo.

## Testes automatizados

Para executar os testes:

```bash
docker compose exec app php artisan test
```

Os testes utilizam SQLite em memória, separado do PostgreSQL usado pela aplicação.

## Encerrar a aplicação

Para parar os containers:

```bash
docker compose down
```

Para remover também o volume do banco de dados:

```bash
docker compose down -v
```

**Atenção:** o segundo comando apaga os dados persistidos no volume do PostgreSQL. Utilize-o somente se quiser reiniciar o banco do zero.