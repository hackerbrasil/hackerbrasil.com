<?php
require 'inc/autoload.php';

$Migration=new Basic\Migration(db());

$db='hb';

$pastaDasTabelas=__DIR__.'/table/';

if($Migration->migrateAll($pastaDasTabelas)){
  print 'migrate ok';
}else{
  print 'migrate error';
}
print PHP_EOL;
