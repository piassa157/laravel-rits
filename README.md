## Teste Rits Back-End

Esse projeto foi desenvolvido apenas para um teste na empresa Rits.
Sendo assim é um codigo construido com livre didática.

## NPM e PHP

Para iniciar o projeto digite os comandos

php artisan serve 

Logo após

npm run dev

## Migrations

php artisan migrate

## ENV

Lembre de alterar o .env para o bd local ou para o desejado.

## Considerações

O projeto é simples, uma API rest com CRUD padrão e um banco de dados sem muitas regras.

As rotas de api são sempre localhost:8000/api/*

Tive dificuldades em criar uma regra de negócio tanto no banco de dados como no código onde seria inserido diversos ids na tabela de demanded (pedidos)
e por isso a criei como varchar e "livre", mas dentro do código utilizei um recurso do laravel onde apenas tais palavras poderiam ser utilizadas.

Não há interface para pedidos, criação de usuários e nem produtos. 

Não utilizei nenhum desing pattern, pois não nunca tive contato com nenhum que eu me lembre.

## Agradecimentos

Desde já agradeço pela oportunidade, mesmo acreditando que há muitos "errinhos" no projeto
me diverti bastante codando e relembrando alguns conceitos. Caso possivel me envie um feedback do código
e de como seria o correto a fazer.
