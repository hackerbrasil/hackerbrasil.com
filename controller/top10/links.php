<?php
$db=db();
$where=[
    'LIMIT'=>10,
    'ORDER'=>[
        'visitas'=>'DESC'
    ]
];
$links=$db->select("links","*",$where);
$data=[
    'title'=>'Top 10 links',
    'links'=>$links
];
view('top10/links',$data);
?>
