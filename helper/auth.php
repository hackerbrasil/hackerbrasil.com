<?php
function getAuth(){
    $db=db();
    return new Basic\Auth($db);
}

function isAuth(){
    $Auth=getAuth();
    return $Auth->isAuth();
}

function logout(){
    $Auth=getAuth();
    return $Auth->logout();
}

function signin(){
    $Auth=getAuth();
    return $Auth->signin();
}
