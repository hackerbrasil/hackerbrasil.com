<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Medoo;

class VisitasController extends Controller
{
    function salvarVisita($urlHash){
        $userToken=request()->cookie('user_token');
        if(strlen($userToken)>=21){
            $db=Medoo::connect();
            $data=[
                'url_hash'=>$urlHash,
                'user_token'=>$userToken,
                'created_at'=>time()
            ];
            $db->insert('visitas',$data);
        }
    }
}
