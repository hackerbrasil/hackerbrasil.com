<?php
$db=db();
$where=[
    'LIMIT'=>10,
    'ORDER'=>[
        'visitas'=>'DESC'
    ]
];
$sites=$db->select("feeds","*",$where);
$data=[
    'title'=>'Top 10 sites',
    'sites'=>$sites
];
view('top10/sites',$data);
?>
