<?php
use FastFeed\Factory;

function feedBaixar($feedId,$feedUrl){
    if(validUrl($feedUrl)){
        $fastFeed = Factory::create();
        $fastFeed->addFeed('default', $feedUrl);
        $where=['url'=>$feedUrl];
        $feed=db()->get('feeds','*',$where);
        if($feed){
            $feedId=$feed['id'];
        }else{
            $data=[
                'url'=>$feedUrl,
                'created_at'=>time()
            ];
            db()->insert('feeds',$data);
            $feedId=db()->id();
        }
        $items = $fastFeed->fetch('default');
        controller("link");
        foreach ($items as $item) {
            $linkTitle=$item->getName();
            $linkUrl=$item->getSource();
            $linkUrl=getHeaderLocation($linkUrl);
            if(validUrl($linkUrl)){
                linkCreate($linkTitle,$linkUrl,$feedId);
            }
        }
    }
}

function feedCreate($feedName,$feedUrl,$feedLanguage='pt'){
    $data=[
        'name'=>$feedName,
        'url'=>$feedUrl,
        'language'=>$feedLanguage,
        'created_at'=>time()
    ];
    $db=db();
    if($db->insert('feeds',$data)){
        return $db->id();
    }else{
        return false;
    }
}

function feedExists($url){
    $where=[
        'url'=>$url
    ];
    return db()->get('feeds','*',$where);
}

function feedLoad(){
    $feeds=require 'listaDeFeeds.php';
    foreach($feeds as $feedName=>$feedUrl){
        $feed=feedExists($feedUrl);
        if($feed){
            $feedId=$feed['id'];
            feedUpdateName($feedName,$feedId);
        }else{
            $feedId=feedCreate($feedName,$feedUrl);
        }
        feedBaixar($feedId,$feedUrl);
    }
}

function feedUpdateName($feedName,$feedId){
    $data=[
        'name'=>$feedName,
        'updated_at'=>time()
    ];
    $where=[
        'id'=>$feedId
    ];
    if(db()->update('feeds',$data,$where)){
        return true;
    }else{
        return false;
    }
}
