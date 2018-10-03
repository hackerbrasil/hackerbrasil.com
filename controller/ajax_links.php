<?php $linkId=@$_GET['linkId']; $pageSize=@$_GET['pageSize']; $links=[
    ['title'=>'Zero'],
    ['title'=>'Um'],
    ['title'=>'Dois'],
    ['title'=>'Três'],
    ['title'=>'Quatro'],
    ['title'=>'Cinco'],
    ['title'=>'Seis'],
    ['title'=>'Sete'],
    ['title'=>'Oito'],
    ['title'=>'Nove'],
    ['title'=>'Dez'],
    ['title'=>'Onze'],
    ['title'=>'Doze'],
];
$links=array_slice($links,$linkId,$pageSize);
if(count($links>0)){
    print json($links);
}else{
    print json(false);
}
