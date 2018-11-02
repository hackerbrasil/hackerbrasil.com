<?php
//sleep(1);

//1) seta o db
$db=db();

//2) seta o numero de links por página
$linksPorPagina=5;

//3) recebe o nextId
$nextId=@$_GET['nextId'];

if(is_numeric($nextId)){
    $nextId=$nextId;
}

//4) verifica se o nextId = false
if($nextId=='false'){
    $where=[
        'LIMIT'=>$linksPorPagina,
        'ORDER'=>[
            'id'=>'DESC'
        ]
    ];
}

//5) verifica se o nextId é numerico
if(is_numeric($nextId)){
    $where=[
        'LIMIT'=>$linksPorPagina,
        'ORDER'=>[
            'id'=>'DESC'
        ],
        'id[<=]'=>$nextId
    ];
}

//6) baixa os links
$links=$db->select('links','*',$where);

//7) seta o próximo nextId
$nextId=@$links[($linksPorPagina-1)]['id'];

//8) caso o nextId não exista baixa os próximos 5
if(!$nextId){
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

//9) conta o numero total de links
$count=$db->count('links');

//10) seta as variaveis de output
$data=[
    'msg'=>$count.' links encontrados',
    'links'=>$links,
    'nextId'=>$nextId-1
];

//11) printa o output em json
print json($data);
