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
                'site'=>'Gizmodo Brasil',
                'title'=>'Noticia 1',
                'created_at'=>time()
            ],
            [
                'site'=>'Tecmundo',
                'title'=>'Noticia 2',
                'created_at'=>time()
            ]
        ];
    }
}
