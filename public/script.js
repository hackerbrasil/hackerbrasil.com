var linksOffset=1;
var linksPerPage=20;
var links;
var linksOffsetMax;
var linksOffsetMin;

function linksGetCookie(){
    return Cookies.get('linksOffset');
}

function linksLoad(linksOffsetCookieValue){
    if(typeof linksOffsetCookieValue=='string'){
        linksOffset=linksOffsetCookieValue;
    }
    //console.log('linksOffset = '+linksOffset);
    var url='/ajax_links?linksOffset='+linksOffset+'&linksPerPage='+linksPerPage;
    //console.log('url = '+url);
    $.getJSON(url, function(links, status){
        linksShow(links);
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

function linksSetCookie(){
    var doisAnos=365*2;
    Cookies.set('linksOffset',linksOffset,{ expires: doisAnos });
    //console.log('cookie linksOffset = '+linksOffset);
}

function linksShow(links){
    //console.log(links);
    linksOffsetMax=links['linksOffsetMax'];
    $('#numeroDeLinks').html(linksOffsetMax);
    //console.log('linksOffsetMax = '+linksOffsetMax);
    linksOffsetMin=links['linksOffsetMin'];
    //console.log('linksOffsetMin = '+linksOffsetMin);
    if(links['links'].length!=0){
        var i=0;
        var text='';
        while (links['links'][i]) {
            title=links['links'][i].title;
            href=links['links'][i].url;
            link='<a target="_blank" href="'+href+'">'+title+'</a>';
            text +='<li>'+link+'</li>';
            i++;
        }
        $('#links').html(text);
        linksSetCookie();
    }else{
        linksOffset=1;
        linksLoad();
    }
}

$(function(){
    //links
    linksLoad(linksGetCookie());

    //foco
    $('#s').focus();
});
