<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LinksController;
use Medoo;

class HomeController extends Controller
{
    function mostrarAViewHome(){
        $db = Medoo::start();
        var_dump($db->info());
        // $LinksController=new LinksController();
        // $data=[
        //     'links'=>$LinksController->lerOsLinksNoBancoDeDados()
        // ];
        // return view('home',$data);
    }
}
