<div class="col-sm-12">
    <div class="btn-group pull-right m-t-15">
        <a href="<?php echo ADMIN_SITE_URL; ?>/guides" class="btn btn-default">Guides</a>
    </div>

    <h4 class="page-title">Add Guide</h4>
    <p class="text-muted page-title-alt">Here you can add user guides to help people navigate the website</p>
</div>

<div class="col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form role="form" method="post" action="<?php echo ADMIN_SITE_URL; ?>/insertguide">
                <div class="form-group">
                    <input name="title" type="text" class="form-control" placeholder="<?php echo Filtration\Core\System::translate("Enter a Title for user guide"); ?>">
                </div>
                <div class="form-group">	
                    <input name="SITE_URL" type="text" class="form-control" placeholder="<?php echo Filtration\Core\System::translate("Enter a url for user guide"); ?>">
                </div>

                <div class="form-group">
                    <textarea id="ckeditor" name="message" class="form-control ckeditor" rows="10"></textarea>
                    <button class="btn btn-blue btn-icon pull-right"><?php echo Filtration\Core\System::translate("Add User Guide"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
