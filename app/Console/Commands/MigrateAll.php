<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Basic\Migration;

use Medoo;

class MigrateAll extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'migrate:all';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Migrar todas as tabelas';

    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $db = Medoo::connect();
        $Migration=new Migration($db);
        $pastasDasTabelas=$_SERVER['PWD'].'/app/Http/Models/';
        if($Migration->migrateAll($pastasDasTabelas)){
            system('clear');
            print 'Tabelas migradas com sucesso'.PHP_EOL;
        }
    }

    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function handle()
    {
        //
    }
}
