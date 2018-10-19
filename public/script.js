var nextId=false;

function carregarLinks(nextId){
    var url='/carregarLinks?nextId='+nextId;
    msg('Carregando links...');
    $.getJSON(url, function(result, status){
        msg(result.msg);
    });
}

function msg(msg){
    $('#carregando').html(msg);
}

function log(mixed){
    console.log(mixed);
}

carregarLinks(nextId);
