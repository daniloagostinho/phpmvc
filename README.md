# duosystem
##Teste de PHP para duosystem

######Conteúdo da Aplicação

**Tela de Listagem**

• Tela para listar as atividades, podendo filtrar pelo “Status” e pela “Situação”;
• A cada atividade listada, deve-se checar o “Status” dela e se for “Concluído”, alterar a cor de fundo da linha;
• Na linha de cada atividade listada, exibir um botão de “Editar” para acessar a tela de edição da atividade;
• No final da tela, exibir um botão para incluir uma nova atividade.

**Tela de Cadastro/Alteração**

• Tela para fazer a manutenção das atividades, podendo alterar os campos disponíveis,respeitando as regras citadas a seguir.

**Cada atividade consiste em:**

• Nome
• Descrição
• Data de Início
• Data de Fim
• Status (itens pré-cadastrados: Pendente, Em Desenvolvimento, Em Teste, Concluído)
• Situação (Ativo, Inativo)

(1)  Os itens disponíveis em “Status” devem ser previamente cadastrados em uma tabela
no banco de dados. Não deve ter tela para manutenção do mesmo.


**Deve-se considerar as regras:**

1) O campo nome é de preenchimento obrigatório e deve possuir o total de 255 caracteres;
2) O campo descrição é de preenchimento obrigatório e deve possuir o total de 600 caracteres;
3) O campo data de início é de preenchimento obrigatório e deve ser no formato “DATE”;
4) O campo data de fim não é de preenchimento obrigatório desde que o status da atividade seja diferente de “Concluído” (deve ser no formato “DATE”);
5) Uma vez uma atividade marcada com o status “Concluído” ela jamais poderá ter alguma informação alterada (inclusive o status);

**Tecnologias utilizadas**

• PHP
• Mysql
• HTML
• CSS
• Bootstrap
• Javascript/Jquery/Ajax
• GIT

**Também foi utilizado:**

• Orientação a objetos;
• Utilização da estrutura MVC; 
• Tipagem correta dos dados no banco de dados;

##instruções

• O dump da base está no diretório /bd-mysql/atividade.sql
• Configurar os dados de conexão no /config/BDConfig.php
• Configurar o path local em /config/properties.php (linha 7)

######Obrigado
##deigmar@gmail.com

