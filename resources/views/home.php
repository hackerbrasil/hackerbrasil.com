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
                foreach($links as $link){
                    if($i++==1){
                        print '<tr id="'.$link['id'].'" class="primeiroLinkDaLista">';
                    }else{
                        print '<tr id="'.$link['id'].'">';
                    }
                    print '<th scope="row">'.$link['site'].'</th>';
                    print '<td>'.$link['title'].'</td>';
                    print '<td>'.$link['created_at'].'</td>';
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
    <script src="https://cdn.rawgit.com/hackerbrasil/hackerbrasil/master/public/js/keynavigator.min.js" integrity="sha384-7/yFCCASGxu6NLsbLH2SqRBxT7A7ADzT21wRrSrXF5oXkJGi4+jHuFeQvU9svbNB" crossorigin="anonymous"></script>
    <script type="text/javascript">
    //funções
    function removerLink(id){
        var $element = $('#'+id);
        $element.fadeOut(500,function(){
            $element.hide()
        });
    }
    //eventos
    $(function(){
        //variaveis
        //https://github.com/nekman/keynavigator
        var listaDeLinks=$('#listaDeLinks tbody tr').keynavigator();
        var primeiroLinkDaLista=$('#listaDeLinks tr:first-child');
        //eventos
        listaDeLinks.keynavigator.setActive(primeiroLinkDaLista);
        primeiroLinkDaLista.trigger('click');

        $(document).bind('keydown',function(e){
            if(e.keyCode == 88) {
                $el=$('#listaDeLinks tbody .active')
                alert($el.attr('id'));
            }
        });
    });
    </script>
</body>
</html>
