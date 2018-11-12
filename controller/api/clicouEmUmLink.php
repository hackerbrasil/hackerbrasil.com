<?php
$id=segment(3);
if(is_numeric($id)){
    $db=db();
    $where=[
        'id'=>$id
    ];
    $link=$db->get("links","*",$where);
    if($link){
        $visitas=$link['visitas'];
        if(is_numeric($visitas)){
            $link['visitas']=$visitas+1;
        }else{
            $link['visitas']=1;
        }
        $db->update('links',$link,$where);
        print json(true);
    }else{
        print json(false);
    }
}else{
    print json(false);
}
?>
