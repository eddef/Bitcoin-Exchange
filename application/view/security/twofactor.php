<div class="col-xs-12 col-sm-8 col-sm-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Two Factor Authentication"); ?></h3>
        </div>

        <div class="panel-body">
            
            <div class="col-sm-4">
                <?php $qrCodeurl = $this->ga->getQRCodeGoogle_url($this->user->user_id . "@" . SITE_NAME, $this->secret); ?>
                <img src="<?php echo $qrCodeurl; ?>" class='col-xs-12'>
            </div>

            <div class="col-sm-8">';
                <form action="<?php echo SITE_URL; ?>security/twofactor_action" method="POST">
                    <?php echo Filtration\Core\System::translate("Authentication Key"); ?>
                    <input name='2key' type='text' class='form-control' value="<?php echo $this->secret; ?>">
			 </div>

             <div class='col-sm-8'>";
                <div class="form-group"> <?php echo Filtration\Core\System::translate("Authentication Code"); ?>
                <input name="2code" type="text" class="form-control" placeholder="<?php echo Filtration\Core\System::translate("Enter Code"); ?>">
                <br>
                <h5>
                    <?php echo Filtration\Core\System::translate("Download Google authenticator and scan the barcode. Once scanned
			            a number should appear in the authenticator app. Fill out our
			            input with that code and click submit authentication on this site."); ?>
                </h5>
                <p>
                    <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">
                        <?php echo Filtration\Core\System::translate("Submit authentication"); ?>
                    </button>
                </p>
            </div>
        </div>  
    </div>
</div>