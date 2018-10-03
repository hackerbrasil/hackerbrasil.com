//variaveis
var defaultLinkId=1;
var defaultPageSize=2;
var linkId;
var pageSize;


//funções diversas
function  atualizarLinks(){
    var url='/ajax_links?linkId='+linkId+'&pageSize='+pageSize;
    $.get(url, function(links, status){
        exibirLinks(links);
    });
}

function downPage(){
    linkId=linkId+pageSize;
    atualizarLinks();
}

function exibirLinks(links){
    if(links==false){
        if(getLinkId()<defaultLinkId){
            //TODO pedir via ajax o id do último link adicionado, setar o link e em seguida atualizar os links
            setLinkId(defaultLinkId);
        }else{
            setLinkId(defaultLinkId);
            atualizarLinks();
        }
    }else{
        var i=0;
        var text='';
        while (links[i]) {
            text +='<li>'+links[i].title+'</li>';
            i++;
        }
        $('#links').html(text);
    }
}

function upPage(){
    linkId=linkId-pageSize;
    atualizarLinks();
}

//get
function getLinkId(){
    return linkId;
}

function getPageSize(){
    return pageSize;
}

//set
function setLinkId(linkIdValue){
    if(linkIdValue>0){
        linkId=linkIdValue;
    }else{
        linkId=defaultIdValue;
    }
}

function setPageSize(pageSizeValue){
    if(pageSizeValue>0){
        pageSize=pageSizeValue;
    }else{
        pageSize=defaultPageSize;
    }
}

//load
$(function(){
    setLinkId(1);
    setPageSize(3);
    atualizarLinks();
});
