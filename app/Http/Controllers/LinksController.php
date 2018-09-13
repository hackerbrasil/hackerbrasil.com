<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinksController extends Controller
{
    function adicionarLinkAoBancoDeDados(){

    }

    function gerarUid($limit=11){
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
        // $uuid = '';
        // for ($i = 0; $i < $limit; $i++) {
        //     $uuid .= $characters[rand(0, mb_strlen($characters)-1)];
        // }
        // $where=[
        //     'uuid'=>$uuid
        // ];
        // if($this->db->get('users','*',$where)){
        //     return $this->uuid();
        // }else{
        //     return $uuid;
        // }
    }

    function lerOsLinksNoBancoDeDados(){
        $db = new Medoo();
        return [
            [
                'uid'=>1,
                'site'=>'Gizmodo Brasil',
                'title'=>'Noticia 1',
                'created_at'=>time()
            ],
            [
                'uid'=>'2',
                'site'=>'Tecmundo',
                'title'=>'Noticia 2',
                'created_at'=>time()
            ],
            [
                'uid'=>'3',
                'site'=>'Tecmundo',
                'title'=>'Noticia 2',
                'created_at'=>time()
            ],
            [
                'uid'=>'4',
                'site'=>'Tecmundo',
                'title'=>'Noticia 2',
                'created_at'=>time()
            ]
        ];
    }
}
