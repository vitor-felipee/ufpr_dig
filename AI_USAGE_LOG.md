# Relatório de Uso de Inteligência Artificial Generativa

Este documento registra todas as interações significativas com ferramentas de IA generativa (como Gemini, ChatGPT, Copilot, etc.) durante o desenvolvimento deste projeto. O objetivo é promover o uso ético e transparente da IA como ferramenta de apoio, e não como substituta para a compreensão dos conceitos fundamentais.

## Política de Uso

O uso de IA foi permitido para as seguintes finalidades:

- Geração de ideias e brainstorming de algoritmos.
- Explicação de conceitos complexos.
- Geração de código boilerplate (ex: estrutura de classes, leitura de arquivos).
- Sugestões de refatoração e otimização de código.
- Debugging e identificação de causas de erros.
- Geração de casos de teste.

É proibido submeter código gerado por IA sem compreendê-lo completamente e sem adaptá-lo ao projeto. Todo trecho de código influenciado pela IA deve ser referenciado neste log.

---

## Registro de Interações

### Interação 1

**Data:** 28/11/2025

**Etapa do Projeto:** Back-end (Criação do Banco de Dados)

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Criar a estrutura inicial do banco de dados para suportar usuários e histórico.

**Prompt(s) Utilizado(s):**

1. "Preciso de um script PHP que verifique se o banco de dados existe e, caso não, crie as tabelas 'usuarios' e 'partidas' com chaves estrangeiras."

**Resumo da Resposta da IA:**
A IA detalhou os comandos SQL necessários (`CREATE TABLE IF NOT EXISTS...`) e a estrutura de um script PHP robusto para gerenciar a criação do banco de dados.

**Análise e Aplicação:**
Segui o passo a passo da IA para montar a estrutura inicial do `createDataBase.php`. Adicionei as tabelas de 'ligas' e 'membrosLigas' aplicando a lógica de Foreign Key ensinada.

**Referência no Código:**
Arquivo `createDataBase.php`.

---

### Interação 2

**Data:** 29/11/2025

**Etapa do Projeto:** Front-end / Dados

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Gerar um dicionário de palavras para o jogo.

**Prompt(s) Utilizado(s):**

1. "Gere um array JSON contendo cerca de 1000 palavras aleatórias em português, variando entre curtas, médias e longas, para um jogo de digitação."

**Resumo da Resposta da IA:**
A IA auxiliou na coleta de 1000 palavras em português e formatou a estrutura JSON.

**Análise e Aplicação:**
Utilizei a estrutura JSON gerada para popular o arquivo `palavras.json`.

**Referência no Código:**
Arquivo `palavras.json`.

---

### Interação 3

**Data:** 29/11/2025

**Etapa do Projeto:** Front-end / Lógica JS

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Entender como carregar um arquivo JSON externo no Javascript.

**Prompt(s) Utilizado(s):**

1. "Como eu faço para ler um arquivo 'palavras.json' local usando Javascript puro e colocar em um array?"

**Resumo da Resposta da IA:**
A IA explicou o funcionamento do `fetch()` e como converter a resposta em JSON.

**Análise e Aplicação:**
Apliquei o padrão `fetch(...).then(...)` no `jogo.js`.

**Referência no Código:**
Arquivo `scripts/jogo.js`, linhas 29–37.

---

### Interação 4

**Data:** 30/11/2025

**Etapa do Projeto:** Front-end / Visual

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Melhorar o feedback visual do input de digitação.

**Prompt(s) Utilizado(s):**

1. "Como fazer um efeito de brilho azul ao redor do input quando ele está focado usando CSS/Bootstrap?"

**Resumo da Resposta da IA:**
A IA sugeriu usar `box-shadow` no estado `:focus`.

**Análise e Aplicação:**
Implementei o efeito no estado normal para destacar a área.

**Referência no Código:**
Arquivo `styles/jogo.css`, linha 1 a 3.

---

### Interação 5

**Data:** 30/11/2025

**Etapa do Projeto:** Front-end / Lógica JS

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Lógica de comparação letra a letra.

**Prompt(s) Utilizado(s):**

1. "Qual a melhor forma de verificar letra a letra a digitação do usuário?"

**Resumo da Resposta da IA:**
Sugeriu separar a palavra em `<span>` e usar classes CSS.

**Análise e Aplicação:**
Implementei a estrutura com spans e cursor visual.

**Referência no Código:**
Arquivo `scripts/jogo.js` linha 54 a 59 e `styles/jogo.css` linha 10 a 23.

---

### Interação 6

**Data:** 12/11/2025

**Etapa do Projeto:** Front-end / Matemática

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Cálculo de PPM e Precisão.

**Prompt(s) Utilizado(s):**

1. "Como calcular PPM e precisão?"

**Resumo da Resposta da IA:**
Forneceu as fórmulas padrão.

**Análise e Aplicação:**
Implementei em `jogo.js`.

**Referência no Código:**
Funções `calcularVelocidade` e `calcularPrecisao`.

---

### Interação 7

**Data:** 30/11/2025

**Etapa do Projeto:** Front-end / Debugging

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Capturar corretamente teclas (incluindo espaço).

**Prompt(s) Utilizado(s):**

1. "Minha lógica não detecta espaço. Qual evento usar?"

**Resumo da Resposta da IA:**
Usar `keydown` e tratar `event.key`.

**Análise e Aplicação:**
Troquei `input` por `keydown`.

**Referência no Código:**
Arquivo `scripts/jogo.js`, linha 116.

---

### Interação 8

**Data:** 01/12/2025

**Etapa do Projeto:** Front-end / Visual

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Centralizar container no Bootstrap.

**Prompt(s) Utilizado(s):**

1. "Como centralizar vertical e horizontalmente?"

**Resumo da Resposta da IA:**
Usar `d-flex`, `justify-content-center`, `align-items-center`, `vh-100`.

**Análise e Aplicação:**
Apliquei em `login.php` e `registro.php`.

---

### Interação 9

**Data:** 01/12/2025

**Etapa do Projeto:** Back-end / Segurança

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Hash seguro de senhas.

**Prompt(s) Utilizado(s):**

1. "Qual o padrão seguro de hashing de senhas no PHP?"

**Resumo da Resposta da IA:**
Usar `password_hash` e `password_verify`.

**Análise e Aplicação:**
Implementei nos arquivos de processamento de registro/login.

**Referência no Código:**
`processarRegistro.php` e `processarLogin.php`.

---

### Interação 10

**Data:** 01/12/2025

**Etapa do Projeto:** Back-end / Integração

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Enviar JSON do JS para PHP.

**Prompt(s) Utilizado(s):**

1. "Como enviar JSON via fetch e ler no PHP?"

**Resumo da Resposta da IA:**
Usar `fetch` com `Content-Type: application/json` e ler com `php://input`.

**Análise e Aplicação:**
Criei `salvarPartida.php`.

**Referência no Código:**
`scripts/jogo.js linhas 187 a 211` e `salvarPartida.php`.

---

### Interação 11

**Data:** 03/12/2025

**Etapa do Projeto:** Back-end / SQL

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Query de classificação geral.

**Prompt(s) Utilizado(s):**

1. "Como calcular médias e ordenar por PPM?"

**Resumo da Resposta da IA:**
Orientou o uso de `AVG`, `GROUP BY` e `JOIN`.

**Análise e Aplicação:**
Apliquei em `classificacao.php` linha 7 a 12.

---

### Interação 12

**Data:** 03/12/2025

**Etapa do Projeto:** Back-end / Funcionalidade

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Filtrar ranking semanal.

**Prompt(s) Utilizado(s):**

1. "Como filtrar últimos 7 dias?"

**Resumo da Resposta da IA:**
Ensinou o uso de `DATE_SUB` e alternativa via `strtotime`.

**Análise e Aplicação:**
Optei por calcular no PHP.

**Referência no Código:**
`classificacao.php` linha 14 e `verLiga.php` linha 36.

---

### Interação 13

**Data:** 04/12/2025

**Etapa do Projeto:** Back-end / Funcionalidade

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Filtrar ranking semanal.

**Prompt(s) Utilizado(s):**

1. "Como filtrar últimos 7 dias?"

**Resumo da Resposta da IA:**
Ensinou o uso de `DATE_SUB` e alternativa via `strtotime`.

**Análise e Aplicação:**
Optei por calcular no PHP.

**Referência no Código:**
`classificacao.php` linha 14 e `verLiga.php` linha 36.

---

### Interação 14

**Data:** 06/12/2025

**Etapa do Projeto:** Back-end / Ligas (Membros)

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Prevenir que o usuário entre duas vezes na mesma liga.

**Prompt(s) Utilizado(s):**

1. "Antes de inserir um usuário na tabela membrosLigas, como posso fazer uma consulta SQL rápida para verificar se a dupla id_usuario e id_liga já existe?"

**Resumo da Resposta da IA:**  
A IA orientou realizar um `SELECT` com `WHERE id_usuario = X AND id_liga = Y` e verificar se `mysqli_num_rows` é maior que zero, indicando duplicidade.

**Análise e Aplicação:**  
Implementei essa verificação antes dos INSERTs nos blocos `btn_criar` e `btn_entrar`, evitando adicionar o mesmo usuário à liga mais de uma vez.

**Referência no Código:**  
`ligas.php` linhas 66-70.

---

### Interação 15

**Data:** 04/12/2025

**Etapa do Projeto:** Documentação

**Ferramenta de IA Utilizada:** Gemini

**Objetivo da Consulta:** Criar README.md.

**Prompt(s) Utilizado(s):**

1. "Gere um modelo de README para projeto PHP/JS/MySQL?"

**Resumo da Resposta da IA:**
Template completo.

**Análise e Aplicação:**
Reescrevi e personalizei.

**Referência no Código:**
`README.md`.

---
