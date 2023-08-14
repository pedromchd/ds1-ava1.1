# Desenvolvimento de Sistema Interno para Loja de Cartuchos/CDs Vintage

Prezados,

Considerando o exemplo anterior do uso de login, vamos desenvolver um sistema interno simples em PHP/HTML/MySQL para uma loja de cartuchos/CDs vintage de video games das décadas de 80, 90 e 2000.

## Funcionalidades do Sistema

1. **Sistema de Login:** Utilizaremos o mesmo sistema de login mencionado em aula. Teremos uma tabela adicional para armazenar informações sobre os cartuchos adicionados por cada usuário. A tabela terá os seguintes campos: id, nome do cartucho/CD, sistema, tela, ano (Atari, Nintendo, Mega-drive, Odyssey, Xbox, PS1, PS2, PS3, MSX).

   (PARA PENSAR: Como armazenar uma imagem de tela no MySQL?) BLOB ou string? 😄

2. **Tela Home:** Após o login correto, a tela Home exibirá um menu para cadastro de jogos para o usuário atual. Um formulário permitirá a inserção de informações sobre o cartucho a ser cadastrado.

3. **Mostrar Cartuchos:** O menu também terá um item para mostrar todos os cartuchos do usuário logado.

4. **Menu Pesquisa:** Apenas o administrador terá acesso a esse menu. Será possível realizar pesquisas avançadas, incluindo:

   i) Quem possui o cartucho XXXXX?
   ii) Qual é o cartucho mais antigo? Quem é o dono?
   iii) Número de jogos para uma dada plataforma/sistema.

## Administração e Entrega

O trabalho pode ser realizado em duplas ou individualmente. A entrega está prevista para o dia **3 de abril**.

## Observações

1. **Design:** Desenvolvam telas adequadas e visualmente atraentes usando CSS, Materialize, Bootstrap, etc.

2. **Segundo Trabalho:** O segundo trabalho será baseado neste sistema e é mandatório desenvolvê-lo.

## Segundo Trabalho (CRUD Completo)

Prezados,

No segundo trabalho, vocês deverão criar um CRUD completo baseado no primeiro trabalho, incluindo as seguintes funcionalidades:

I) Adicionar botões e funcionalidades de remoção e edição.

II) Criação de uma tabela "histórico" de remoção, para armazenar todos os dados que já foram removidos, com seus respectivos donos e data de remoção.

III) Utilização de bibliotecas para geração dos seguintes relatórios:

   a) Relatório completo pela administração, listando todos os jogos com seus respectivos donos.
   b) Relatório completo pelo usuário, listando todos os seus jogos.
   c) Relatório da administração com todos os cartuchos removidos, em ordem da remoção mais atual para a mais antiga.
   d) Relatório resumo com título, dono e imagens apresentadas de maneira matricial (3 imagens por linha, 5-6 linhas por página).
   e) Criação de uma tabela de sistemas (NES, MASTER_SYSTEM, etc.) e uma página para a administração atualizar, remover e inserir dados dos sistemas.

Esperamos um ótimo trabalho por parte de todos!

Atenciosamente,
[Seu Nome]
