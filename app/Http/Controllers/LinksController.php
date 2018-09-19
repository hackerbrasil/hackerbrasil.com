<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Medoo;

class LinksController extends Controller
{
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
        if( $what === NULL )
        {
            //  Character      Decimal      Use
            //  "\0"            0           Null Character
            //  "\t"            9           Tab
            //  "\n"           10           New line
            //  "\x0B"         11           Vertical Tab
            //  "\r"           13           New Line in Mac
            //  " "            32           Space

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

    // function gerarLinkUid($limit=11){
    //     $db = Medoo::connect();
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
    //     $uid = '';
    //     for ($i = 0; $i < $limit; $i++) {
    //         $uid .= $characters[rand(0, mb_strlen($characters)-1)];
    //     }
    //     $where=[
    //         'uid'=>$uid
    //     ];
    //     if($db->get('links','*',$where)){
    //         return $this->gerarLinkUid();
    //     }else{
    //         return $uid;
    //     }
    // }

    function lerOsLinksNoBancoDeDados(){
        $db = Medoo::connect();
        $where=['id[>]'=>0];
        $links=$db->select('links','*',$where);
        if(is_array($links) && count($links)>0){
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
