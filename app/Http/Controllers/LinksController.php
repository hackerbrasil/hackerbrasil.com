<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Medoo;

use App\Http\Controllers\VisitasController;

class LinksController extends Controller
{
    function abrirLink(){
        $url_hash=@$_POST['url_hash'];
        $db=Medoo::connect();
        $where=[
            'url_hash'=>$url_hash
        ];
        $link=$db->get("links","*",$where);
        if($link){
            $VisitasController=new VisitasController();
            $VisitasController->salvarVisita($link['url_hash']);
        }
        return response()->json($link);
    }

    function ocultarLink(){
        $url_hash=@$_POST['url_hash'];
        $db=Medoo::connect();
        $where=[
            'url_hash'=>$url_hash
        ];
        $link=$db->get("links","*",$where);
        if($link){
            $VisitasController=new VisitasController();
            $VisitasController->salvarVisita($link['url_hash'],'skip');
        }
        return response()->json(true);
    }

    function adicionarLinkAoBancoDeDados($title,$url,$feedId){
        $title=$this->limparTudo($title);
        if($this->validUrl($url)){
            $urlHash=md5($url);
            $db = Medoo::connect();
            $where=['url_hash'=>$urlHash];
            $link=$db->get('links','*',$where);
            if($link){
                //atualizar link
                if($link['title']<>$title){
                    $data=[
                        'title'=>$title,
                        'updated_at'=>time(),
                        'feed_id'=>$feedId
                    ];
                    $where=[
                        'id'=>$link['id']
                    ];
                    $db->update('links',$data,$where);
                }
            }else{
                //criar link
                $data=[
                    'title'=>$title,
                    'url'=>$url,
                    'created_at'=>time(),
                    'feed_id'=>$feedId,
                    'url_hash'=>$urlHash
                ];
                $db->insert('links',$data);
            }
            print substr($urlHash,0,10).'... '.$title.PHP_EOL;
        }
    }

    function limparTudo($str , $what = NULL , $with = ' '){
        if( $what === NULL ){
            $what   = "\\x00-\\x20";    //all white-spaces and control chars
        }
        return trim( preg_replace( "/[".$what."]+/" , $with , $str ) , $what );
    }

    function validUrl($url){
        if(filter_var($url, FILTER_VALIDATE_URL)){
            return true;
        }else{
            return false;
        }
    }

    function lerLinksViaAjax(){

    }

    function lerOsLinksNoBancoDeDados(){
        $db = Medoo::connect();
        $where=[
            'id[>]'=>0
        ];
        $links=$db->select('links','*',$where);
        if(is_array($links) && count($links)>0){
            $userHash=request()->cookie('user_hash');
            foreach($links as $key=>$link){
                $where=[
                    'AND'=>[
                        'user_hash'=>$userHash,
                        'url_hash'=>$link['url_hash']
                    ]
                ];
                $visita=$db->get('visitas','*',$where);
                if($visita){
                    unset($links[$key]);
                }
            }
            return $this->lerONomeDoFeedDosLinks($links);
        }else{
            return [];
        }
    }
    function lerONomeDoFeedDosLinks($links){
        $feeds=[];
        $db = Medoo::connect();
        foreach ($links as $key => $link) {
            $where=[
                'id'=>$link['feed_id']
            ];
            if(isset($feeds[$link['feed_id']])){
                $feed=$feeds[$link['feed_id']];
            }else{
                $feed=$db->get('feeds','*',$where);
                $feeds[$link['feed_id']]=$feed;
            }
            $links[$key]['feed_name']=$feed['name'];
        }
        return $links;
    }
}
