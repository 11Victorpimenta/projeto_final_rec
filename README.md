# Sistema de Avaliação de Produtos

Projeto desenvolvido para a disciplina de Laboratório de Inovação III.

A ideia do sistema é permitir que o usuário visualize produtos, escolha um deles e faça uma avaliação com comentário e nota por estrelas. Depois, essa avaliação pode ser alterada ou excluída pela página de gerenciamento.

O projeto não possui login, cadastro de usuário ou autenticação. O foco ficou apenas nas funcionalidades principais de avaliação de produtos.

## Tecnologias utilizadas

* PHP
* HTML
* CSS
* JavaScript
* MySQL
* XAMPP

## Arquitetura

O sistema foi feito em duas camadas.

A primeira camada é o cliente, acessado pelo navegador, onde ficam as telas feitas com HTML, CSS e JavaScript.

A segunda camada é o servidor, onde o PHP processa as informações e acessa o banco de dados MySQL.

## Funcionalidades

O sistema foi dividido com base nas operações principais do CRUD:

* Read: listar produtos disponíveis para avaliação
* Create: criar uma avaliação com nota e comentário
* Update: atualizar uma avaliação já cadastrada
* Delete: excluir uma avaliação

A exclusão usada no projeto é lógica. Ou seja, a avaliação não é apagada diretamente do banco, apenas tem o status alterado para `excluida`.

## Divisão das funcionalidades

* 1.1 Página de Produtos / Read — Bruno
* 1.2 Criar Avaliação / Create — Levi
* 1.3 Atualizar Avaliação / Update — João
* 1.4 Excluir Avaliação / Delete — Victor

## Estrutura do projeto

```text
projeto-reviews/
├── index.php
├── produtos.php
├── avaliar.php
├── editar_avaliacao.php
├── gerenciar_avaliacoes.php
├── css/
│   └── style.css
├── js/
│   └── script.js
├── php/
│   ├── conexao.php
│   ├── salvar_avaliacao.php
│   ├── atualizar_avaliacao.php
│   └── excluir_avaliacao.php
├── database/
│   ├── banco.sql
│   └── sprint2_3.sql


```

## Banco de dados

O banco utilizado no projeto se chama `sistema_avaliacao`.

As principais tabelas são:

* `produtos`: guarda os produtos que aparecem na página inicial.
* `avaliacoes`: guarda a nota, o comentário, o status e as datas da avaliação.

O relacionamento funciona assim: um produto pode ter várias avaliações, mas cada avaliação pertence a apenas um produto.

## Como executar

Para rodar o projeto, basta colocar a pasta dentro do `htdocs` do XAMPP, iniciar o Apache e o MySQL, importar o arquivo `database/banco.sql` no phpMyAdmin e acessar o projeto pelo navegador usando o localhost.

## Status do projeto

Funcionalidades já implementadas:

* Página de produtos
* Página de criação de avaliação
* Salvamento da avaliação no banco
* Listagem das avaliações
* Edição de avaliação
* Exclusão lógica de avaliação

O projeto ainda pode receber ajustes finais de interface, documentação e organização para a entrega final.
