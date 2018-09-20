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
        $userToken=request()->cookie('user_token');
        if($userToken){
            return response()
            ->view('home',$data);
        }else{
            $umDia=24*60;
            $umAno=365*$umDia;
            $minutes=2*$umAno;
            return response()
            ->view('home',$data)
            ->cookie('user_token', $this->criarUserToken(10), $minutes);
        }
    }
    function criarUserToken($limit=11,$special=false){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        if($special){
            $characters.= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $characters.= '_-';
        }
        $uid = '';
        for ($i = 0; $i < $limit; $i++) {
            $uid .= $characters[rand(0, mb_strlen($characters)-1)];
        }
        return $uid.'_'.time();
    }
}
