//variaveis globais
var linksEnd;
var linksPageSize=2;
var linksPointer;
var links;
var linkBegin;

//funções
function downLinks(){

}

function setLinks(links,linkBegin){
    //links.length
    linkBegin=linkBegin-1;
    linksEnd=linkBegin+linksPageSize;
    var text = "";
    while (linkBegin<linksEnd) {
        var link=links[linkBegin];
        text +='<li id="'+link.id+'">'+link.title+'</li>';
        linkBegin=linkBegin+1;
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
        {'id':'5','title':'Cinco'},
        {'id':'6','title':'Cinco'}
    ];
    setLinks(links,3);
});
