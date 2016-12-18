<div class="col-sm-12">
    <div class="btn-group pull-right m-t-15">
        <a href="<?php echo ADMIN_SURL; ?>/addguide" class="btn btn-default">Add Guide</a>
    </div>

    <h4 class="page-title">Guides</h4>
    <p class="text-muted page-title-alt">Here you can manage your user guides to help people navigate the website</p>
</div>

<div class="col-md-12">
    <div class="panel-group panel-group-joined" id="accordion-test">
        <?php foreach ($this->guides as $guide) { ?>		
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                            <a href="<?php echo ADMIN_SURL; ?>/editguide/<?php echo Filtration\Core\System::escape($guide->guide_id); ?>">
                                <?php echo Filtration\Core\System::escape($guide->guide_title); ?>
                            </a>
                        </a>
                    </h4>
                </div>
            </div>
        <?php } ?>


    </div></div>