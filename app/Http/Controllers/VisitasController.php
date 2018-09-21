<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Medoo;

class VisitasController extends Controller
{
    function salvarVisita($urlHash,$type='view'){
        $type=strtolower($type);
        if($type<>'view'){
            $type='skip';
        }
        $userToken=request()->cookie('user_token');
        if(strlen($userToken)>=21){
            $db=Medoo::connect();
            $data=[
                'url_hash'=>$urlHash,
                'user_token'=>$userToken,
                'created_at'=>time(),
                'type'=>$type
            ];
            $db->insert('visitas',$data);
        }
    }
}
