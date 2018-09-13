<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LinksController;

class HomeController extends Controller
{
    function mostrarAViewHome(){
        $LinksController=new LinksController();
        $data=[
            'links'=>$LinksController->lerOsLinksNoBancoDeDados()
        ];
        return view('home',$data);
    }
}
