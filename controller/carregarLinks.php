<?php
//sleep(1);
$nextId=@$_GET['nextId'];
if($nextId=='false'){
    $where=[
        'LIMIT'=>6,
        'ORDER'=>[
            'id'=>'DESC'
        ]
    ];
}elseif(is_numeric($nextId)){
    $where=[
        'LIMIT'=>6,
        'ORDER'=>[
            'id'=>'DESC'
        ],
        'id[>=]'=>$nextId
    ];
}
$db=db();
$links=$db->select('links','*',$where);
$nextId=@$links[5]['id'];
//caso o nextId não exista
if(!$nextId){
    $where=[
        'LIMIT'=>6,
        'ORDER'=>[
            'id'=>'DESC'
        ]
    ];
    $arrLink=$db->select('links','*',$where);
    $nextId=@$arrLinks[5]['id'];
    unset($arrLinks[5]);
    foreach ($arrLinks as $link) {
        array_push($links,$link);
    }
}
$count=$db->count('links');
$data=[
    'msg'=>$count.' links encontrados',
    'links'=>$links,
    'nextId'=>$nextId
];
print json($data);
