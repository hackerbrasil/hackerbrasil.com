    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    	<h3><?php print $feed['name']; ?>
        </h3>
    </div>
    <div class="modal-body">
        <div class="avisos"></div>
        <h1 class="text-center">
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
        </h1>
    	<button id="btnModalFeed" class="btn btn-large btn-primary btn-block update">
            <i class="icon-white icon-refresh"></i>
            Atualizar
        </button>
    </div>
    <div class="modal-footer">
    	<button type="button" data-dismiss="modal" class="btn">Fechar</button>
    </div>
