<?php
$linksOffset=@$_GET['linksOffset'];
$linksPerPage=@$_GET['linksPerPage'];
$links['links']=[
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
$links['linksOffsetMin']=1;
$links['linksOffsetMax']=count($links['links']);
if($linksOffset<$links['linksOffsetMin']){
    //valor muito baixo
    $linksOffset=$links['linksOffsetMax']-$linksPerPage;
}
if($linksOffset>$links['linksOffsetMax']){
    //valor muito alto
    $linksOffset=$links['linksOffsetMin'];
}
$links['links']=array_slice($links['links'],$linksOffset,$linksPerPage);

//validação
$erro=false;
if($linksOffset<1 OR $linksOffset>$links['linksOffsetMax']){
    $erro=true;
}

//output
if($erro){
    print json(false);
}else{
    print json($links);
}
