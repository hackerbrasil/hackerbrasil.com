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
        </h1>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary update">
            <i class="icon-white icon-refresh"></i>
            Atualizar
        </button>
    	<button type="button" data-dismiss="modal" class="btn">
            <i class="icon-remove"></i>
            Fechar
        </button>
    </div>
