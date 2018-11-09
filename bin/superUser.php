<?php
require './inc/autoload.php';
use Basic\Auth;
$db=db();
$Auth=new Auth($db);
$user=[
    'type'=>'admin',
    'name'=>$_ENV['ADMIN_NAME'],
    'email'=>$_ENV['ADMIN_EMAIL'],
    'password'=>$_ENV['ADMIN_PASSWORD']
];
$where=[
    'email'=>$user['email']
];
$usuarioExiste=$db->get("users","*",$where);
if($usuarioExiste){
        print 'ERRO: O usuário '.$user['name'].' já está cadastrado'.PHP_EOL;
}else{
    $result=$Auth->signup($user);
    if($result){
        print 'Usuário '.$user['name'].' adicionado com sucesso'.PHP_EOL;
    }else{
        print 'Erro ao adicionar o usuário '.$user['name'].PHP_EOL;
        var_dump($db->last());
    }
}
