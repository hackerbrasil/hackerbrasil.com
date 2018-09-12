<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinksController extends Controller
{
    function adicionarLinkAoBancoDeDados(){

    }

    function lerOsLinksNoBancoDeDados(){
        return [
            [
                'id'=>1,
                'site'=>'Gizmodo Brasil',
                'title'=>'Noticia 1',
                'created_at'=>time()
            ],
            [
                'id'=>'2',
                'site'=>'Tecmundo',
                'title'=>'Noticia 2',
                'created_at'=>time()
            ]
        ];
    }
}
