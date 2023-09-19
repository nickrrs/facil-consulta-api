## Observações

> No docker-composer, alterei a porta local do banco para "3333" para não conflitar com ferramentas de trabalho que utilizo atualmente. Caso prefira, pode optar por mudar para a porta padrão 3306 do mysql.

> Rode os seeds manualmente por classe ( db:seed --class=[NomeDaClasse]) ou db:seed para executar todos de uma vez.

> Todas operações realizadas via terminal WSL.

> ENV EXAMPLE com os dados de ambiente que usei.

> Para autenticação, dentro dos seeders, criei um usuário padrão para logar e testar. Porém, deixei por fora uma rota de cadastro manual, caso queiram testar também (/api/register).
