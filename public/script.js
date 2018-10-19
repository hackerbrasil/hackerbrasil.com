var i=0;
var nextId=false;

function carregarLinks(nextId){
    var url='/carregarLinks?nextId='+nextId;
    msg('Carregando links...');
    $.getJSON(url, function(links, status){
        linksShow(links);
    });
}

function gatilhoDoFim(){
    $('#pacman').appear(function() {
        log("pacman "+i);
        i=i+1;
        $('ul').append('<li>'+i+'</li>');
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
            var linkText='<a target="_blank" href="'+link.url+'">'+link.title+'</a>';
            linkText+='<span x-date="'+link.created_at+'"></span>';
            text +='<li>'+linkText+'</li>';
            i++;
        }
        $('#links').append(text);
        nextId=links.nextId;
        msg(links.msg);
        gatilhoDoFim();
    }else{
        log('erro ao exibir links');
    }
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
