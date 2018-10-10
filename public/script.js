var linksOffset=1;
var linksPerPage=20;
var links;
var linksOffsetMax;
var linksOffsetMin;
var linkUpdateInterval;

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
            var linkText='<a target="_blank" href="'+link.href+'">'+link.title+'</a>';
            linkText+='<span class="tempoAtras" x-data="'+link.created_at+'"></span>';
            text +='<li>'+linkText+'</li>';
            i++;
        }
        $('#links').html(text);
        moment.locale('pt-br');
        clearInterval(linkUpdateInterval);
        linkUpdateInterval=setInterval(linksUpdate, 1);
    }else{
        linksOffset=1;
        linksLoad();
    }
}

function linksUpdate(){
    $('#links > li > span').each(function (index, value) {
        var xData=$(this).attr('x-data');
        var mom=moment.unix(xData);
        var dataText=mom.startOf("seconds").fromNow();
        $(this).html(' <small>'+dataText+'</small>');
    });
}

$(function(){
    //links
    linksLoad();

    //foco
    $('#s').focus();
});
