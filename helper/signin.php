<?php
function isAuth(){
    $db=db();
    $Auth=new Basic\Auth($db);
    return $Auth->isAuth();    
}
function signin(){
    $db=db();
    $Auth=new Basic\Auth($db);
    return $Auth->signin();
}
?>
