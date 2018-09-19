<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use FastFeed\Factory;

use Medoo;

use App\Http\Controllers\LinksController;

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
        $feeds=[
            'http://gizmodo.com.br/feed'
        ];
        $LinksController=new LinksController();
        foreach ($feeds as $key => $feedUrl) {
            if($LinksController->validUrl($feedUrl)){
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
                    $LinksController->adicionarLinkAoBancoDeDados($title,$url,$feedId);
                }
            }
        }
    }
}
