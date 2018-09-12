<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\Medoo;

class HomeController extends Controller
{
    function mostrarAViewHome(){
        $db = new Medoo();
        var_dump($db->info());
        // $LinksController=new LinksController();
        // $data=[
        //     'links'=>$LinksController->lerOsLinksNoBancoDeDados()
        // ];
        // return view('home',$data);
    }
}
