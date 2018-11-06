<?php
//sleep(1);

//1) seta o db
$db=db();

//2) seta o numero de links por página
$linksPorPagina=10;

//3) recebe o nextId
if(@is_numeric($_GET['nextId'])){
    $nextId=$_GET['nextId'];
}else{
    $nextId=false;
}

//4) nextId = false
if($nextId=='false'){
    $where=[
        'LIMIT'=>$linksPorPagina,
        'ORDER'=>[
            'id'=>'DESC'
        ]
    ];
}

//5) nextId numerico
if(is_numeric($nextId)){
    $where=[
        'LIMIT'=>$linksPorPagina,
        'ORDER'=>[
            'id'=>'DESC'
        ],
        'id[<=]'=>$nextId
    ];
}

//6) caso a busca esteja ativa adiciona os termos da busca no where
if(isset($_GET['s'])){
    $s=@$_GET['s'];
    $where['title[~]']=$s;
}

var_dump($nextId);

//7) baixa os links
$links=$db->select('links','*',$where);

//8) seta o próximo nextId
$nextId=@$links[($linksPorPagina-1)]['id'];

//9) caso o nextId não exista repete os mesmos resultados para completar a pagina
if(!$nextId && !isset($_GET['s'])){
    $where=[
        'LIMIT'=>($linksPorPagina+1),
        'ORDER'=>[
            'id'=>'DESC'
        ]
    ];
    $arrLinks=$db->select('links','*',$where);
    $nextId=@$arrLinks[$linksPorPagina]['id'];
    unset($arrLinks[$linksPorPagina]);
    foreach ($arrLinks as $link) {
        array_push($links,$link);
    }
}

//10) conta o numero total de links
$count=$db->count('links');

//11) seta as variaveis de output
$data=[
    'msg'=>$count.' links encontrados',
    'links'=>$links,
    'nextId'=>$nextId-1
];

//12) printa o output em json
//print json($data);
