<?php
$linkId=@$_GET['linkId'];
$pageSize=@$_GET['pageSize'];
$links=[
    ['title'=>'Zero'],
    ['title'=>'Um'],
    ['title'=>'Dois'],
    ['title'=>'Três'],
    ['title'=>'Quatro'],
    ['title'=>'Cinco'],
    ['title'=>'Seis'],
    ['title'=>'Sete'],
    ['title'=>'Oito'],
    ['title'=>'Nove'],
    ['title'=>'Dez'],
    ['title'=>'Onze'],
    ['title'=>'Doze'],
];
$count=count($links);//total de links
$links=array_slice($links,$linkId,$pageSize);

//validação
$erro=false;
if($linkId<0 OR $linkId>$count){
    $erro=true;
}

//output
if($erro){
    print json(false);
}else{
    print json($links);
}
