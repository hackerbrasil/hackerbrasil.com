# migration
:pencil: Sistema básico de migration

## Composer
	composer require basic/migration

## Instalação
O Migration funciona por injeção de dependência. Para tanto é necessário ter o [Medoo](http://medoo.in/) instalado e configurado.
```
<?php
require 'vendor/autoload.php';
//$db=Instância do Medoo
$Migration=new Basic\Migration($db);
```
## Exemplo de tabela
O nome do arquivo de texto é o nome da tabela. As tabelas devem ficar armazenadas no diretório /table um nivel acima do diretório /vendor.

### table/user
```
id
name
email
password
token
token_expiration
```

## Apagar todas as tabelas
	$Migration->dropAll();

## Migrar todas as tabelas
	$Migration->migrateAll();

## Esvaziar todas as tabelas
	$Migration->truncateAll();
