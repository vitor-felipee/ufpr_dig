# UFPR DIG - Jogo de Digitação

Este projeto é uma aplicação Web completa desenvolvida como trabalho prático para a disciplina de **DS122 - Desenvolvimento Web 1** da Universidade Federal do Paraná (UFPR).

O sistema consiste em um jogo de digitação, que possui classificaçao de usuário e sistema de ligas.

## 🚀 Tecnologias Utilizadas

- **Front-end:** HTML5, CSS3, JavaScript (Vanilla), Bootstrap 5.3.
- **Back-end:** PHP (Nativo, sem frameworks).
- **Banco de Dados:** MySQL.

## 📋 Arquitetura do Projeto

A arquitetura do projeto é extremamente simples, sendo utilizado o conteúdo aprendido durante a disciplina.

### Front-end

- **Mecânica de Digitação:** Jogo desenvolvido inteiramente em JavaScript, calculando em tempo real:
  - PPM (Palavras por Minuto).
  - Precisão (%).
  - Contagem de acertos e erros.
- **Interface:** Design desenvolvido com o Framework Bootstrap 5 (único que eu conhecia um pouco) e CSS para estilzar a letra do jogo.

### Back-end

Simples, com muito do processamento sendo feito na própria página.

- **Autenticação:** Sistema de registro e login de usuários com senhas criptografadas, usando a função do PHP `password_hash`.
- **Histórico:** Armazenamento no banco de dados de todas as partidas jogadas pelo usuário, inclusive guardando a data.
- **Sistema de Ligas:**
  - Usuários podem criar ligas privadas protegidas por senha (palavra-chave).
  - Ranking específico para membros da liga.
- **Classificação dos jogadores:**
  - Ranking Geral e também semanal.
  - Filtros por média de PPM e precisão.

## 📂 Estrutura de Arquivos

- `index.php`: Dashboard principal com estatísticas do usuário, permite ir para o jogo.
- `jogo.php` e `scripts/jogo.js`: Interface e lógica do jogo.
- `ligas.php`: Gerenciamento de ligas (criar, entrar, listar).
- `verLiga.php`: Classificação dentro da liga.
- `classificacao.php`: Ranking geral e semanal, de todos os usuários.
- `connection.php` & `credentials.php`: Configuração de conexão com BD.

## 🛡️ Segurança

Foram aplicadas validações simples:

- Verificação de formulários no back-end para impedir envio de campos vazios.
- Sanitização de entradas utilizando `mysqli_real_escape_string`.

## 🔧 Como Rodar o Projeto

1.  **Requisitos:**

    - Servidor Web.
    - PHP instalado.
    - MySQL instalado.

2.  **Instalação:**

    - Clone este repositório na pasta pública do seu servidor (no XAMPP, `htdocs`).
    - Configure as credenciais do banco de dados no arquivo `credentials.php`:
      ```php
      $server = "localhost";
      $usuario = "root";
      $password = ""; // Coloque sua senha do MySql
      ```

3.  **Configuração do Banco de Dados:**

    - Acesse no navegador o arquivo de instalação automática:
      `http://localhost/ufpr-dig/createDataBase.php`
    - Este script criará o banco `ufpr_dig` e todas as tabelas necessárias (`usuarios`, `partidas`, `ligas`, `membrosLigas`).

4.  **Acesso:**
    - Acesse a página inicial: `http://localhost/ufpr-dig/index.php`
    - Crie uma conta e comece a jogar.

## ✒️ Autores

- **Vitor Felipe** - GRR20252106

---

_Trabalho desenvolvido para a disciplina de Desenvolvimento Web 1 - SEPT/UFPR._
