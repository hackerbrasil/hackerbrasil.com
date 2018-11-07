<?php
function getFeedById($id){
    $db=db();
    $where=[
        'id'=>$id
    ];
    return $db->get('feeds','*',$where);
}
function mostrarTelaDoFeed($feed){
    $db=db();
    $where=[
        'feed_id'=>$feed['id']
    ];
    $data=[
        'feed'=>$feed,
        'totalDeLinks'=>$db->count('links',$where)
    ];
    view('feed',$data);
}
?>
