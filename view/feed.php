<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?php print $feed['name']; ?></title>
    <?php view("inc/assets"); ?>
</head>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="offset4 span4">
                <h1>
                    <?php print $feed['name']; ?><br>
                    <small>
                        <?php
                        if($totalDeLinks==0){
                            print 'Nenhum link';
                        }
                        if($totalDeLinks==1){
                            print '1 link';
                        }
                        if($totalDeLinks>1){
                            print $totalDeLinks.' links';
                        }
                        ?>
                    </small>
                </h1>

                <a class="btn btn-large btn-block btn-primary" rel="nofollow" href="<?php print $feed['url'];?>" target="=_blank">Ir para o feed</a>
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
    <?php view("inc/footer"); ?>
</body>
</html>
