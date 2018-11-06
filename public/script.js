var i=0;
var nextId=false;
var linkUpdateInterval;
var buscaAtiva=false;
var termosDaBuscaStr=false;

function buscar(str){
    nextId=false;
    carregarLinks(nextId,str);
}

function carregarLinks(nextId,termosDaBuscaStr){
    termosDaBuscaStr=termosDaBuscaStr;
    if(termosDaBuscaStr){
        buscaAtiva=true;
        var url='/carregarLinks?nextId='+nextId+'&s='+termosDaBuscaStr;
        limparLista();
    }else{
        buscaAtiva=false;
        var url='/carregarLinks?nextId='+nextId;
    }
    msg('Carregando links...');
    $.getJSON(url, function(links, status){
        linksShow(links);
    });
}

function gatilhoDoFim(){//carrega links ao chegar no fim da lista
    if($('#s').val().length==0){
        buscaAtiva=false;
    }
    $('#gatilho').appear(function() {
        if(buscaAtiva && nextId){
            carregarLinks(nextId,termosDaBuscaStr);
        }else if(nextId){
            carregarLinks(nextId);
        }
    });
}

function msg(msg){//exibe uma mensagem
    $('#carregando').html(msg);
}

function limparLista(){
    $('#links').html('');
}

function linksShow(links){
    if(links['links'].length!=0){
        var i=0;
        var text='';
        msg(links.msg);
        while (links['links'][i]) {
            var link=links['links'][i];
            title=timeConverter(link.created_at);
            var linkText='<a title="'+title+'" rel="nofollow" target="_blank" href="'+link.url+'">';
            linkText+=link.title;
            linkText+='</a>';
            linkText='<span class="pull-right data-right" x-date="'+link.created_at+'"></span>'+linkText;
            text +='<li>'+linkText+'</li>';
            i++;
        }
        $('#links').append(text);
        linkUpdateInterval=setInterval(linksUpdate, 100);
        nextId=links.nextId;
        gatilhoDoFim();
    }else{
        msg(links.msg);
    }
}

function linksUpdate(){//atualizar o cronometro
    $('#links > li > span').each(function (index, value) {
        var xDate=$(this).attr('x-date');
        var dataText=timeSince(xDate);
        $(this).html(' <small class="badge">'+dataText+'</small>');
    });
}

function timeConverter(UNIX_timestamp){//unix epoch to date
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    hour=("00" + hour).slice(-2);
    var min = a.getMinutes();
    min=("00" + min).slice(-2);
    var sec = a.getSeconds();
    sec=("00" + sec).slice(-2);
    //var time = date + '/' + month + '/' + year + ' ' + hour + ':' + min + ':' + sec ;
    var time = date + '/' + month + '/' + year;
    return time;
}

function timeSince(date) {//cronômetro
    var seconds = Math.floor(((new Date().getTime()/1000) - date)),
    interval = Math.floor(seconds / 31536000);
    //if (interval > 1) return interval + " y";
    if (interval >= 1) return timeConverter(date);
    interval = Math.floor(seconds / 2592000);
    //if (interval > 1) return interval + " m";
    if (interval >= 1) return timeConverter(date);
    interval = Math.floor(seconds / 86400);
    //if (interval >= 1) return interval + " d";
    if (interval >= 1) return timeConverter(date);
    interval = Math.floor(seconds / 3600);
    if (interval >= 1) return interval + " h";
    interval = Math.floor(seconds / 60);
    if (interval >= 1) return interval + " m";
    return Math.floor(seconds) + " s";
}

$(function() {//gatilhos
    $('#s').val('');
    $('#s').focus();
    carregarLinks(nextId);
    $('#10').scrolling({ offsetTop: -200 });
    $('#10').on('scrollin', function(event, $all_elements) {
        $(this).animate({opacity: 1}, 600);
    });
    $('#10').on('scrollout', function(event, $all_elements) {
        $(this).animate({opacity: 0}, 200);
    });
    $("#s").keyup(function() {
        buscar($(this).val());
    });
});
