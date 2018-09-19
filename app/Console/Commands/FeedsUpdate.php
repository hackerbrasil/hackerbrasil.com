<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use FastFeed\Factory;

use Medoo;

class FeedsUpdate extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'feeds:update';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Atualizar ou criar feeds Atom ou RSS';

    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function handle()
    {
        system('clear');
        $db = Medoo::connect();
        $fastFeed = Factory::create();
        $feedUrl='http://gizmodo.com.br/feed';
        $fastFeed->addFeed('default', $feedUrl);
        $where=['url'=>$feedUrl];
        $feed=$db->get('feeds','*',$where);
        if($feed){
                $feedId=$feed['id'];
        }else{
            $data=[
                'url'=>$feedUrl,
                'created_at'=>time()
            ];
            $db->insert('feeds',$data);
            $feedId=$db->id();
        }
        $items = $fastFeed->fetch('default');
        foreach ($items as $item) {
            $title=$item->getName();
            $url=$item->getSource();
            $where=['url'=>$url];
            $link=$db->get('links','*',$where);
            if($link){
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
                $data=[
                    'title'=>$title,
                    'url'=>$url,
                    'created_at'=>time(),
                    'feed_id'=>$feedId
                ];
                $db->insert('links',$data);
            }
            print $title.PHP_EOL;
        }
    }
}
