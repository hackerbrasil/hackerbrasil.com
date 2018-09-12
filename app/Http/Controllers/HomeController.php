<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function mostrarAViewHome(){
        $data=[
            'links'=>[
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
            ]
        ];
        return view('home',$data);
    }
}
