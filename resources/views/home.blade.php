<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hacker Brasil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <style media="screen">
    .active {
        background: #69f;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
    }
    #listaDeLinks tr:hover{
        cursor:pointer;
    }
    </style>
</head>
<body>
    <h1>Hacker Brasil</h1>
    <div class="table-responsive-sm table-borderless" id="listaDeLinks">
        <table class="table table-sm">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Site</th>
                    <th scope="col">Artigo</th>
                    <th scope="col" colspan="2">Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                foreach($links as $key=>$link){
                    // print '<pre>';
                    // die(var_dump($link));
                    if($i++==1){
                        print '<tr id="'.$link['url_hash'].'" class="primeiroLinkDaLista">';
                    }else{
                        print '<tr id="'.$link['url_hash'].'">';
                    }
                    print '<th class="link" scope="row">'.$link['feed_name'].'</th>';
                    print '<td class="link">'.$link['title'].'</td>';
                    print '<td class="link">'.$link['created_at'].'</td>';
                    print '<td class="text-right align-middle">';
                    print '<a class="badge badge-danger" href="javascript:void(0);" onclick="removerLink($(this).closest(\'tr\').attr(\'id\'));">';
                    print '<i class="fas fa-times"></i>';
                    print '</a>';
                    print '</td>';
                    print '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/keynavigator.min.js') }}" integrity="{{ integrity('/js/keynavigator.min.js') }}" crossorigin="anonymous"></script>
    <script type="text/javascript">
    //variaveis
    //https://github.com/nekman/keynavigator
    var listaDeLinks=$('#listaDeLinks tbody tr');
    listaDeLinks.keynavigator();
    var primeiroLinkDaLista=$('#listaDeLinks tr:first-child');

    //funções
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
            xhrFields: { withCredentials: true }
        });
        //eventos
        primeiroLinkDaLista.trigger('click');
        $(document).bind('keydown',function(e){
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
    </script>
</body>
</html>
