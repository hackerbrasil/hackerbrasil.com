<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use FastFeed\Factory;

class BaixarFeeds extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'baixar:feeds';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Baixar feeds Atom ou RSS';

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
        $fastFeed = Factory::create();
        $fastFeed->addFeed('default', 'http://gizmodo.com.br/feed');
        $items = $fastFeed->fetch('default');
        foreach ($items as $item) {
            $title=$item->getName();
            $url=$item->getSource();
            $row = Lazer::table('links')->where('url', '=', $url)->find();
            if(isset($row->id)){
                $row->title = $title;
                $row->updated_at=time();
            }else{
                $row = Lazer::table('links');
                $row->title = $title;
                $row->url = $url;
                $time=time();
                $row->created_at=$time;
                $row->updated_at=$time;
                $row->save();
            }
            print $title.PHP_EOL;
        }
    }
}
