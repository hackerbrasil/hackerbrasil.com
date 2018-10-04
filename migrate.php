<?php
require 'config.php';
$Migration=new Basic\Migration($db);

if($Migration->migrateAll()){
  print 'migrate ok';
}else{
  print 'migrate error';
}
print PHP_EOL;
