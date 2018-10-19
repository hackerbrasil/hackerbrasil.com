<?php
$where=[
    'LIMIT'=>5,
    'ORDER'=>[
        'id'=>'DESC'
    ]
];
$db=db();
$links=$db->select('links','*',$where);
$count=$db->count('links');
$data=[
    'msg'=>$count.' links encontrados',
    'links'=>$links
];
print json($data);
