//variaveis globais
var links;

//funções
function downLinks(){

}

function setLinks(links){
    var max=links.length-1;
    var text = "";
    for (var i = 0;links[i];i++) {
        var link=links[i];
        text +='<li id="'+link.id+'">'+link.title+'</li>';
    }
    $('#links').append(  text );
}

function upLinks(){

}

$(function(){
    links=[
        {'id':'1','title':'Um'},
        {'id':'2','title':'Dois'},
        {'id':'3','title':'Três'},
        {'id':'4','title':'Quatro'},
        {'id':'5','title':'Cinco'}
    ];
    setLinks(links);
});
