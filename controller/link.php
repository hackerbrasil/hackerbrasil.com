<?php
function linkCreate($linkTitle,$linkUrl,$feedId,$feedLanguage='pt'){
    $link=linkExists($linkUrl);
    if($link){
        $linkId=$link['id'];
        if($link['title']<>$linkTitle){
            linkUpdate($link,$linkTitle,$feedId);
        }
        print 'skip '.$linkTitle.PHP_EOL;
    }else{
        $data=[
            'title'=>$linkTitle,
            'url'=>$linkUrl,
            'feed_id'=>$feedId,
            'created_at'=>time(),
            'url_hash'=>md5($linkUrl),
            'language'=>$feedLanguage
        ];
        db()->insert("links",$data);
        print 'add '.$linkTitle.PHP_EOL;
    }
}

function linkExists($linkUrl){
    $where=[
        'url'=>$linkUrl
    ];
    return db()->get('links','*',$where);
}

function linkUpdate($linkTitle,$feedId,$linkId){
    $data=[
        'title'=>$linkTitle,
        'feed_id'=>$feedId,
        'updated_at'=>time()
    ];
    $where=[
        'id'=>$linkId
    ];
    db()->update('links',$data,$where);
}
