<?php
$link_id=@$_GET['link_id'];
$page_size=@$_GET['page_size'];
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
header('Content-Type: application/json');
$links=array_slice($links,$link_id,$page_size);
print json_encode($links);
