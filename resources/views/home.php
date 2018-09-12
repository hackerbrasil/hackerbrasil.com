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
    </style>
</head>
<body>
    <h1>Hacker Brasil</h1>
    <div class="table-responsive-sm">
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
                        print '<tr id="primeiraLinha">';
                    }else{
                        print '<tr>';
                    }
                    print '<th scope="row">'.$link['site'].'</th>';
                    print '<td>'.$link['title'].'</td>';
                    print '<td>'.$link['created_at'].'</td>';
                    print '<td class="text-right align-middle">';
                    print '<i class="fas fa-times"></i>';
                    print '</td>';
                    print '</tr>';
                }
                ?>
                </tbody>
                </table>
                </div>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
                <script src="https://cdn.rawgit.com/hackerbrasil/hackerbrasil/master/public/js/keynavigator.min.js"></script>
                <script type="text/javascript">
                //https://github.com/nekman/keynavigator
                var listaDeLinks=$('table > tbody tr').keynavigator();
                var primeiraLinha=$('#primeiraLinha');
                listaDeLinks.keynavigator.setActive(primeiraLinha);
                primeiraLinha.trigger('click');

                //       $(function() {
                //   var $listaDeLinks = $('table > tbody tr').keynavigator({
                //     // Don't activate on anything...
                //     activateOn: ''
                //   });
                //
                //   // Handle activation your self.
                //   $listaDeLinks.find('td').on('click', function(e) {
                //     var $input = $(this),
                //         $selectedRow = $input.closest('tr');
                //
                //     $listaDeLinks.keynavigator.setActive($selectedRow);
                //
                //     // Keep focus on input
                //     $input.focus();
                //
                //     // Stop event bubbling
                //     e.stopPropagation();
                //   });
                // });
                </script>
                </body>
                </html>
