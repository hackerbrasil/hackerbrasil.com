<?php
require './inc/autoload.php';

if(!isCli()){
    die('CLI mode only!');
}

helper('criarFeed');

echo 'Digite o nome do feed (ex: Gizmodo):'.PHP_EOL;
$arr= preg_split('/\s+/', trim(read_from_console()));
$name=implode(' ',$arr);
print PHP_EOL;
echo 'Digite o URL do feed:'.PHP_EOL;
$arr= preg_split('/\s+/', trim(read_from_console()));
$url=implode(' ',$arr);
print PHP_EOL;
$feed=feedExists($url);
if($feed){
    $id=$feed['id'];
    if(feedUpdateName($name,$id)){
        echo 'Feed atualizado com sucesso'.PHP_EOL;
    }else{
        echo 'Erro ao atualizar o feed'.PHP_EOL;
    }
}else{
    if(feedCreate($name,$url,'pt')){
        echo 'Feed criado com sucesso'.PHP_EOL;
    }else{
        echo 'Erro ao criar feed'.PHP_EOL;
    }
}
