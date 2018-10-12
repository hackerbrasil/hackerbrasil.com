var linksOffset=1;
var linksPerPage=20;
var links;
var linksOffsetMax;
var linksOffsetMin;
var linkUpdateInterval;

function irParaOTopo() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function linksLoad(){
    //console.log('linksOffset = '+linksOffset);
    var url='/ajax_links?linksOffset='+linksOffset+'&linksPerPage='+linksPerPage;
    //console.log('url = '+url);
    $("body").loading({
        message: 'Atualizando...'
    });
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
            var link=links['links'][i];
            var linkText='<a target="_blank" href="'+link.href+'">'+link.title+'</a>';
            linkText+='<span x-date="'+link.created_at+'"></span>';
            text +='<li>'+linkText+'</li>';
            i++;
        }
        $('#links').html(text);
        moment.locale('pt-br');
        clearInterval(linkUpdateInterval);
        linkUpdateInterval=setInterval(linksUpdate, 100);
        $("body").loading('stop');
    }else{
        linksOffset=1;
        linksLoad();
    }
}

function linksUpdate(){
    $('#links > li > span').each(function (index, value) {
        var xDate=$(this).attr('x-date');
        // var mom=moment.unix(xData);
        // var dataText=mom.startOf("seconds").fromNow();
        var dataText=timeSince(xDate);
        $(this).html(' <small>'+dataText+'</small>');
    });
}

function mostrarBtnIrParaOTopo() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("btnIrParaOTopo").style.display = "block";
    } else {
        document.getElementById("btnIrParaOTopo").style.display = "none";
    }
}

function timeSince(date) {
    var seconds = Math.floor(((new Date().getTime()/1000) - date)),
    interval = Math.floor(seconds / 31536000);
    if (interval > 1) return interval + "y";
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) return interval + "m";
    interval = Math.floor(seconds / 86400);
    if (interval >= 1) return interval + "d";
    interval = Math.floor(seconds / 3600);
    if (interval >= 1) return interval + "h";
    interval = Math.floor(seconds / 60);
    if (interval >= 1) return interval + "m";
    return Math.floor(seconds) + "s";
}

$(function(){
    //links
    linksLoad();

    //foco
    $('#s').focus();

    // topo
    window.onscroll = function() {mostrarBtnIrParaOTopo()};
});
