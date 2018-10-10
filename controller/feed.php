<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

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
    db()->insert('feeds',$data);
}

function feedExists($url){
    $where=[
        'url'=>$url
    ];
    return db()->get('feeds','*',$where);
}

function feedLoad(){
    $feeds=[
        'Canaltech'=>'http://feeds2.feedburner.com/canaltechbr',
        'Gizmodo Brasil'=>'http://gizmodo.com.br/feed',
        'Mundo dos Hackers'=>'http://www.mundodoshackers.com.br/feed',
        'Olhar Digital'=>'http://feeds2.feedburner.com/canaltechbr'
    ];
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
    db()->update('feed',$data,$where);
}
