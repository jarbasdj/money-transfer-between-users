#### Implementações:

 - [x] Cadastro de usuários via API Restful.
 - [x] Transferência de valor entre usuários levando em consideração as regras descritas no desafio.
 - [x] Processamento assíncrono de transferências, via fila.
 - [x] Validação de saldo antes de realizar a transferência, levando em consideração as transações pendentes do usuário.
 - [ ] Lógica de notificações e testes

Para implementar as notificações, usaria um listener no model de transações para enviar as notificações usando o mecanismos de notificações do laravel.

# Stack

 - PHP 8
 - Laravel 8
 - Docker
 - MySql
 - Redis

#### Minhas implementações:

**Controllers:** 
> app/Http/Controllers/TransactionController
> app/Http/Controllers/UserController

**Requests**
> app/Http/Requests/*

**Repositories**
> app/Repositories/*

**Repositories**
> app/Jobs/*

**Services**
> app/Services/*

**Model**
> app/Models/Transaction.php

**Observers**
> app/Models/TransactionObserver.php

**Migration**
> database/migrations/*
# Subir o Projeto

Na raíz do projeto rode o comando `docker-compose up -d`.

Entre no container `php`, rode `composer install`. Renomeie o arquivo `.env.example` para `.env`.

| Porta local web
|--|
| 80 |

That's it for now, enjoy!