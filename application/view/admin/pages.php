<div class="col-md-9">
    <div class="panel-group" id="accordion-test-2">
        <?php foreach ($this->pages as $page) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion-test-<?php echo $page->id; ?>" href="#collapseOne-<?php echo $page->page_id; ?>" class="collapsed">
                            <?php echo $page->page_title; ?>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne-<?php echo $page->page_id; ?>" class="panel-collapse collapse" style="height: 0px;">
                    <div class="panel-body">
                        <?php echo $page->page_body; ?>
                        <br/>
                        <a class="btn btn-danger pull-right" value="" href="<?php echo ADMIN_SURL; ?>/editpage/<?php echo $page->page_id; ?>">
                            <?php echo Filtration\Core\System::translate("Edit page"); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div> 