//variaveis
var defaultLinkId=1;
var defaultPageSize=2;
var linkId;
var pageSize;


//funções diversas
function  atualizarLinks(){
    var url='/ajax_links?linkId='+getLinkId()+'&pageSize='+getPageSize();
    console.log('Baixando url = '+url);
    $.get(url, function(links, status){
        exibirLinks(links);
    });
}

function downPage(){
    //1) define linkIdValue=linkId+pageSize
    var linkIdValue=linkId+pageSize;
    //2) verifica se o linkIdValue existe via ajax
    var url='/ajax_link_existe?linkId='+linkIdValue;
    $.get(url, function(existe, status){
        if(existe){
        //2.true) define linkId=linkIdValue
        setLinkId(linkIdValue);
        }else{
        //2.false) define linkId=defaultLinkId
        setLinkid(defaultLinkId);
        }
    });
    //3) atualiza a página
    atualizarLinks();
}

function exibirLinks(links){
    //1) processa o resultado
    if(links){
        //2.true) imprime os links e atualiza o cookie
        var i=0;
        var text='';
        while (links[i]) {
            text +='<li>'+links[i].title+'</li>';
            i++;
        }
        $('#links').html(text);
        setLinkIdCookie(linkId);
    }else{
        //2.false) define o linkId com o valor default e atualiza o cookie
        setLinkId(defaultLinkId);
        setLinkIdCookie(defaultLinkId);
    }
}

function upPage(){
    //1) verifica se o valor do linkId é maior ou igual ao valor default do linkId
    if(linkId>=defaultLinkId){
        //1.true) define linkId=linkId-pageSize
        var linkIdValue=linkId-pageSize;
    }else{
        //1.false) define linkId=defaultValue
        var linkIdValue=defaultLinkId;
    }
    //2) setar linkId
    setLinkId(linkIdValue);
    //3) atualizar links
    atualizarLinks();
}

//get
function getLinkId(){
    return linkId;
}

function getLinkIdCookie(){
    return Cookies.get('linkId');
}

function getPageSize(){
    return pageSize;
}

//set
function setLinkIdCookie(linkIdCookieValue){
    //https://github.com/js-cookie/js-cookie
    var doisAnos=365*2;
    Cookies.remove('linkId');
    Cookies.set('linkId',linkIdCookieValue,{ expires: doisAnos });
}

function setLinkId(linkIdValue){
    if(linkIdValue>0){
        linkId=linkIdValue;
    }else{
        linkId=defaultLinkId;
    }
    console.log("Link = "+linkId);
}

function setPageSize(pageSizeValue){
    if(pageSizeValue>0){
        pageSize=pageSizeValue;
    }else{
        pageSize=defaultPageSize;
    }
    console.log("Tamanho da página = "+pageSize);
}

//load
$(function(){
    //1) define o pageSize
    setPageSize(3);
    //2) verifica se existe um cookie
    var linkIdCookieValue=getLinkIdCookie();
    if(linkIdCookieValue){
        //2.true) define o linkId com o valor do cookie
        setLinkId(linkIdCookieValue);
    }else{
        //2.false) defina o linkId com o valor default
        setLinkId(defaultLinkId);
    }
    //3) baixar o link id e exibir os links
    atualizarLinks();
});
