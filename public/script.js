function loadingStart(el){
    $(el).loading({
        theme: 'dark',
        message: 'Carregando...'
    });
}

function loadingStop(el){
    $(el).loading('stop');
}


function require(nomeDaFuncao,callback){
    $.getScript('js/'+nomeDaFuncao+'.js', function() {
        callback();
    });
}

$(function(){

    loadingStart('body');

    require('carregarLinks', function() {
        carregarLinks('olá mundo');
        loadingStop('body');

    });
});
