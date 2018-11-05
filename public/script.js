var i=0;
var nextId=false;
var linkUpdateInterval;

function carregarLinks(nextId){
    var url='/carregarLinks?nextId='+nextId;
    msg('Carregando links...');
    $.getJSON(url, function(links, status){
        linksShow(links);
    });
}

function gatilhoDoFim(){
    $('#pacman').appear(function() {
        carregarLinks(nextId);
    });
}

function msg(msg){
    $('#carregando').html(msg);
}

function log(mixed){
    console.log(mixed);
}

function linksShow(links){
    if(links['links'].length!=0){
        var i=0;
        var text='';
        while (links['links'][i]) {
            var link=links['links'][i];
            var linkText='<a rel="nofollow" target="_blank" href="'+link.url+'">';
            linkText+=link.title;
            linkText+='</a>';
            linkText='<span class="pull-right data-right" x-date="'+link.created_at+'"></span>'+linkText;
            text +='<li>'+linkText+'</li>';
            i++;
        }
        $('#links').append(text);
        linkUpdateInterval=setInterval(linksUpdate, 100);
        nextId=links.nextId;
        msg(links.msg);
        gatilhoDoFim();
    }else{
        log('erro ao exibir links');
    }
}

function linksUpdate(){
    $('#links > li > span').each(function (index, value) {
        var xDate=$(this).attr('x-date');
        // var mom=moment.unix(xData);
        // var dataText=mom.startOf("seconds").fromNow();
        var dataText=timeSince(xDate);
        $(this).html(' <small class="badge">'+dataText+'</small>');
    });
}

function timeSince(date) {
    var seconds = Math.floor(((new Date().getTime()/1000) - date)),
    interval = Math.floor(seconds / 31536000);
    if (interval > 1) return interval + " y";
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) return interval + " m";
    interval = Math.floor(seconds / 86400);
    if (interval >= 1) return interval + " d";
    interval = Math.floor(seconds / 3600);
    if (interval >= 1) return interval + " h";
    interval = Math.floor(seconds / 60);
    if (interval >= 1) return interval + " m";
    return Math.floor(seconds) + " s";
}

$(function() {
    carregarLinks(nextId);
    $('#10').scrolling({ offsetTop: -200 });
    $('#10').on('scrollin', function(event, $all_elements) {
        $(this).animate({opacity: 1}, 600);
    });
    $('#10').on('scrollout', function(event, $all_elements) {
        $(this).animate({opacity: 0}, 200);
    });
});
