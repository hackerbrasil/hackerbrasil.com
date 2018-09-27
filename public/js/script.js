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
    request.done(function (links, textStatus, jqXHR){

        var i = 0;
        var text = "";

        for (;links[i];) {
            var link=links[i];
            text += '<tr id="'+link.id+'">';
            text +='<th>'+link.feed_name+'</th>';
            text +='<th>'+link.title+'</th>';
            text +='<th>'+link.created_at+'</th>';
            text +='<td class="text-right align-middle">';
            text +='<a class="badge badge-danger" href="javascript:void(0);" onclick="removerLink($(this).closest(\'tr\').attr(\'id\'));">';
            text +='<i class="fas fa-times"></i>';
            text +='</a>';
            text +='</td>';
            text += '</tr>';
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
