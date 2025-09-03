# LegraBet - Sistema de Apostas Esportivas

Este é um sistema simples de apostas esportivas desenvolvido em PHP utilizando o padrão MVC.

## Estrutura do Projeto

```
config/
controllers/
models/
public/
routes/
sql/
views/
README.md
```

## Como rodar o projeto localmente

1. Instale o XAMPP, Laragon ou Docker com PHP e MySQL.
2. Clone este repositório na pasta pública do seu servidor local (ex: `htdocs` ou `www`).
3. Importe o arquivo `sql/init.sql` no seu MySQL para criar as tabelas iniciais.
4. Configure o acesso ao banco de dados em `config/database.php`.
5. Acesse `http://localhost/public` para iniciar o sistema.
