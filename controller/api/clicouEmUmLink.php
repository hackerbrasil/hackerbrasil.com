<?php
$id=segment(3);
if(is_numeric($id)){
    $db=db();
    $where=[
        'id'=>$id
    ];
    $link=$db->get("links","*",$where);
    if($link){
        //verifica se o mesmo link já foi visitado pelo mesmo ip (proteção contra flood)
        $whereVisita=[
            'AND'=>[
                'link_id'=>$id,
                'ip'=>getIp()
            ]
        ];
        $count=$db->count('visitas',$whereVisita);
        if($count<1){
            //registra a visita
            $visita=$whereVisita['AND'];
            $visita['created_at']=time();
            $db->insert('visitas',$visita);
            //adiciona a visita ao link
            $visitas=$link['visitas'];
            if(is_numeric($visitas)){
                $link['visitas']=$visitas+1;
            }else{
                $link['visitas']=1;
            }
            $db->update('links',$link,$where);
        }
        $linkUpdate=true;
    }else{
        $linkUpdate=false;
    }
    //adiciona a visita ao feed
    $where=[
        'id'=>$link['feed_id']
    ];
    if($linkUpdate){
        $feed=$db->get('feeds','*',$where);
    }else{
        $feed=false;
    }
    if($feed){
        $visitas=$feed['visitas'];
        if(is_numeric($visitas)){
            $feed['visitas']=$visitas+1;
        }else{
            $feed['visitas']=1;
        }
        $db->update('feeds',$feed,$where);
        $feedUpdate=true;
    }else{
        $feedUpdate=false;
    }
    //output
    if($linkUpdate && $feedUpdate){
        print json(true);
    }else{
        print json(false);
    }
}else{
    print json(false);
}
?>
