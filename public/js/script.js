//variaveis
var listaDeLinks=$('#listaDeLinks tbody tr');
listaDeLinks.keynavigator();
var primeiroLinkDaLista=$('#listaDeLinks tr:first-child');

//funções
function lerOsLinksViaAjax(){
    var ajaxUrl='/api/lerOsLinksViaAjax';
    request = $.ajax({
        url: ajaxUrl,
        type: "post",
        data: {
            'page':'x'
        }
    });
    request.done(function (response, textStatus, jqXHR){
        console.log(response);

        var i = 0;
        var text = "";

        for (;response[i];) {
            text += '<tr><td id="'+response[i].id+'">';
            text +=response[i].text+'</td></tr>';
            i++;
        }
        $('#tabelaAlvo').append(  text );

    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        alert("Ocorreu um erro inesperado, tente novamente");
    });
}
function salvarLink(url_hash,type){
    // Fire off the request to /form.php
    if(type=='skip'){
        var ajaxUrl="/api/ocultarLink";
    }else{
        var ajaxUrl="/api/abrirLink";
    }

    request = $.ajax({
        url: ajaxUrl,
        type: "post",
        data: {
            '_token':'<?php print csrf_token(); ?>',
            'url_hash':url_hash
        }
    });
    if(type=='view'){
        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            var win = window.open(response.url, '_blank');
            if (win) {
                //Browser has allowed it to be opened
                win.focus();
            } else {
                //Browser has blocked it
                alert('Por favor, habilite as popups para este site');
            }
        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            alert("Ocorreu um erro inesperado, tente novamente");
        });
    }
}

function removerLink(id){
    var link = $('#'+id);
    salvarLink(id,'skip');
    link.fadeOut(500,function(){
        link.hide(function(link){
            primeiroLinkDaLista=$('#listaDeLinks tr:first-child');
            primeiroLinkDaLista.trigger('click');
        });
    });
}

//eventos
$(function(){
    $.ajaxSetup({
        xhrFields: { withCredentials: true },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //eventos
    primeiroLinkDaLista.trigger('click');
    $(document).bind('keydown',function(e){
        //https://github.com/nekman/keynavigator
        if(e.keyCode == 88) {
            link=$('#listaDeLinks tbody .active');
            removerLink(link.attr('id'));
        }
    });
    // $('#listaDeLinks tr').on("dblclick", function(e){
    $('#listaDeLinks tr > .link').
    on("click", function(e){
        salvarLink($(this).closest('tr').attr('id'),'view');
        e.preventDefault();  //cancel system double-click event
    });
});
