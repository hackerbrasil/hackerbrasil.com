function require(nomeDaFuncao,callback){
    $.getScript('js/'+nomeDaFuncao+'.js', function() {
        callback();
    });
}

$(function(){
    require('carregarLinks', function() {
        carregarLinks('olá mundo');
    });
});
