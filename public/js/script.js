//variaveis
var linkId=0;
var pageSize=2;

//funções diversas
function  baixarLinks(linkId){
    var url='/ajax_links?linkId='+linkId+'&pageSize='+pageSize;
    $.get(url, function(links, status){
        if(links){
            exibirLinks(links);
        }
    });
}

function downPage(){
    linkId=linkId+pageSize;
    baixarLinks(linkId);
}

function exibirLinks(links){
    var i=0;
    var text='';
    while (links[i]) {
        text +='<li>'+links[i].title+'</li>';
        i++;
    }
    $('#links').html(text);
}

function upPage(){
    linkId=linkId-pageSize;
    baixarLinks(linkId);
}

//get e set
function getLinkId(){
    return linkId;
}

function setLinkId(linkId=false){
    if(linkId){
        linkId=linkId;
    }else{
        linkId=getLinkId();
    }
    baixarLinks(linkId);
}

//load
$(function(){
    setLinkId();
});
