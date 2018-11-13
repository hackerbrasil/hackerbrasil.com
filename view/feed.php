<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3><?php print $feed['name']; ?></h3>
</div>
<div class="modal-body">
    <div class="avisos"></div>
    <h1 class="text-center">
        <?php print $totalDeLinks; ?>
        <small>
            <?php
            if($totalDeLinks<2){
                print 'link';
            }
            if($totalDeLinks>1){
                print 'links';
            }
            ?>
        </small>
        /
        <?php
        $visitas=$feed['visitas'];
        $msg='visita';
        if($visitas<1){
            $visitas='Nenhuma';
        }
        if($visitas>1){
            $msg='visitas';
        }
        $msg=' <small>'.$msg.'</small>';
        $cliques=$visitas.$msg;
        print $cliques; ?>
    </h1>
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">
        <i class="icon-remove"></i>
        Fechar
    </button>
</div>
