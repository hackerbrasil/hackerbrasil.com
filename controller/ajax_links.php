<?php
sleep(2);
$linksOffset=@$_GET['linksOffset'];
$linksPerPage=@$_GET['linksPerPage'];
$db=db();
$where=[
    'HAVING'=>[
        'id[>=]'=>18
    ],
    'LIMIT'=>$linksPerPage+1,
    'ORDER'=>[
        'id'=>'DESC'
    ]
];
$links['links']=$db->select('links',['title','url','created_at'],$where);
$links['linksOffsetMin']=1;

//contar numero de links
$where=[
    'id[>]'=>0
];
$links['linksOffsetMax']=$db->count('links',$where);


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
