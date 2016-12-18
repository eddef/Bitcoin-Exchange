<div class="col-sm-12">
    <div class="btn-group pull-right m-t-15">
        <a href="<?php echo ADMIN_SURL; ?>/coins" class="btn btn-default">Manage Coin</a>
    </div>

    <h4 class="page-title">Add Coin</h4>
    <p class="text-muted page-title-alt">Here you can add a market to your exhcnage</p>
</div>

<div class="col-xs-12">
    <div class="panel panel-body">
        <form role="form" action="<?php echo ADMINSURL; ?>/addcoin/" method="POST" class="validate" novalidate="novalidate">
            <input type="hidden" name="add_coin" value="1">
            <div class="row col-margin">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <input type="text" name="coinname" placeholder="Coin collum Name" class="form-control" data-validate="required" data-message-required="coin Name">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <input type="text" name="cointitle" class="form-control" data-validate="required"  placeholder="Coin title" data-message-required="<?php echo Filtration\Core\System::translate(" Coin Title "); ?>">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <textarea class="col-xs-12" rows="5" name="coindescription"></textarea>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Coin Enabled </label>
                        <input type="checkbox" name="coinenabled" class="iswitch iswitch-secondary">
                    </div>

                    <button type="submit" name="submit" class="btn btn-danger ">
                        <?php echo Filtration\Core\System::translate("Add coin"); ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>