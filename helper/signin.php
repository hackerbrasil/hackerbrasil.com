<?php
function signin(){
    $db=db();
    $Auth=new Basic\Auth($db);
    return $Auth->signin();
}
?>
