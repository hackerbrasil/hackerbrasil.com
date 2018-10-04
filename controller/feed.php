<?php
function feedBaixar($feedUrl){

}

function feedCreate($feedName,$feedUrl){
/*
name
url
created_at
language
*/
}

function feedExists($url){
    $where=[
        'url'=>$url
    ];
    return $db->get('feeds','*',$where);
}

function feedLoad(){
    $feeds=[
        'Gizmodo Brasil'=>'http://gizmodo.com.br/feed'
    ];
    foreach($feeds as $feedName=>$feedUrl){
        $feed=feedExists($feedUrl);
        if($feed AND $feed['name']!=$feedName){
            $feedId=$feed['id'];
            feedUpdateName($feedName,$feedId);
        }else{
            $feedId=feedCreate($feedName,$feedUrl)
        }
        feedBaixar($feedId,$feedUrl);
    }
}

function feedUpdateName($feeDame,$feedId){

}
