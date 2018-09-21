<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Medoo;

class VisitasController extends Controller
{
    function salvarVisita($urlHash,$type='view'){
        $db=Medoo::connect();
        $type=strtolower($type);
        if($type=='view'){
            $where=[
                'url_hash'=>$urlHash
            ];
            $link=$db->get('links','*',$where);
            if(@$link['visitas']>0){
                $visitas=$link['visitas']+1;
            }else{
                $visitas=1;
            }
            $data['visitas']=$visitas;
            $db->update('links',$data,$where);
        }else{
            $type='skip';
        }
        $userHash=request()->cookie('user_hash');
        if(strlen($userHash)>=21){
            $data=[
                'url_hash'=>$urlHash,
                'user_hash'=>$userHash,
                'created_at'=>time(),
                'type'=>$type
            ];
            $db->insert('visitas',$data);
        }
    }
}
