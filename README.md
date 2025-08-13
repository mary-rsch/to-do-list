# to-do list

Este é um aplicativo simples de To-Do List desenvolvido com **PHP + Laravel + Bootstrap**. Permite criar, editar, listar e excluir tarefas. Feito com a intenção de concorrer a uma vaga de Trainee.

---

## como rodar o projeto?

### pré-requisitos

- Servidor local com PHP instalado (ex: XAMPP, MAMP ou Laragon)
- Banco de dados MySQL ou MariaDB
- Composer instalado ([https://getcomposer.org/](https://getcomposer.org/))

---

### passo a passo

1. Clone o projeto:

```bash
git clone https://github.com/mary-rsch/to-do-list.git
```

2. Entre na pasta do projeto:

```bash
cd to-do-list
```

3. Instale as dependências com composer:

```bash
composer install
```

4. Copie o arquivo .env.example para .env:

```bash
cp .env.example .env
```

5. Configure as credenciais do banco no arquivo .env (exemplo):
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todolist_db
DB_USERNAME=root
DB_PASSWORD=
```
6. Crie o banco de dados no seu phpMyAdmin (por exemplo, todolist_db).

7. Gere a chave da aplicação Laravel:

```bash
php artisan key:generate
```

8. Rode as migrations para criar as tabelas no banco:

```bash
php artisan migrate
```

9. Por fim, rode o servidor local do Laravel:

```bash
php artisan serve
```

10. Acesse o projeto pelo endereço:

http://localhost:8000
