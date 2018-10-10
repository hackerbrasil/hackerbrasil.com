var linksOffset=1;
var linksPerPage=20;
var links;
var linksOffsetMax;
var linksOffsetMin;

function linksLoad(){
    console.log('linksOffset = '+linksOffset);
    var url='/ajax_links?linksOffset='+linksOffset+'&linksPerPage='+linksPerPage;
    console.log('url = '+url);
    $.getJSON(url, function(result, status){
        links=result;
        linksShow();
    });
}

function linksNext(){
    linksOffsetNextValue=linksOffset+linksPerPage;
    if(linksOffsetNextValue<=linksOffsetMax){
        linksOffset=linksOffsetNextValue;
        linksLoad();
    }else{
        linksOffset=linksOffsetMin;
        linksLoad();
    }
}

function linksPrevious(){
    linksOffsetNextValue=linksOffset-linksPerPage;
    if(linksOffsetNextValue>=linksOffsetMin){
        linksOffset=linksOffsetNextValue;
        linksLoad();
    }else{
        linksOffset=linksOffsetMax-linksPerPage;
        linksLoad();
    }
}

function linksShow(){
    console.log(links);
    linksOffsetMax=links['linksOffsetMax'];
    $('#numeroDeLinks').html(linksOffsetMax);
    console.log('linksOffsetMax = '+linksOffsetMax);
    linksOffsetMin=links['linksOffsetMin'];
    console.log('linksOffsetMin = '+linksOffsetMin);
    if(links['links'].length!=0){
        var i=0;
        var text='';
        while (links['links'][i]) {
            var link=links['links'][i];
            var linkText='<span class="tempoAtras" id="'+link.created_at+'"></span>';
            linkText+='<a target="_blank" href="'+link.href+'">'+link.title+'</a>';
            text +='<li>'+linkText+'</li>';
            i++;
        }
        $('#links').html(text);
    }else{
        linksOffset=1;
        linksLoad();
    }
}

$(function(){
    //links
    linksLoad();

    //foco
    $('#s').focus();
});
