<div class="panel col-sm-9 col-xs-12">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Update Coin"); ?></h3>
    </div>
    <div class="panel-body">
        <form role="form" action="<?php echo ADMINSITE_URL; ?>/updatecoin/" method="POST" class="validate" novalidate="novalidate">

            <div class="row col-margin">
                <div class="col-xs-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="linecons-user"></i>
                        </div>
                        <input type="text" name="coinname" class="form-control" data-validate="required" value="<?php echo System::escape($this->coin->coin_coin); ?>" data-message-required="<?php echo Filtration\Core\System::translate("Coin name"); ?>">
                    </div>
                </div>

                <div class="col-xs-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="linecons-user"></i>
                        </div>
                        <input type="text" name="slogan" class="form-control" data-validate="required" value="<?php echo System::escape($this->coin->coin_description); ?>" data-message-required="<?php echo Filtration\Core\System::translate("Coin Description"); ?>">
                    </div>
                </div>

                <div class="col-xs-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="linecons-user"></i>
                        </div>
                        <input type="text" name="cointitle" class="form-control" data-validate="required" value="<?php echo System::escape($this->coin->coin_title); ?>" data-message-required="<?php echo Filtration\Core\System::translate("Coin Title"); ?>">
                    </div>
                </div>
                <div class="col-xs-6">
                    <label class="col-sm-6 control-label">Coin Enabled </label>

                    <div class="col-sm-6">
                        <div class="form-block">
                            <input type="checkbox" name="maintenance" <?php
                            if ($this->coin->coin_enabled == 'enabled') {
                                echo 'checked="checked"';
                            }
                            ?>" class="iswitch iswitch-secondary">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-danger ">
                <?php echo Filtration\Core\System::translate("Update"); ?>
            </button>
            </label>
            </p>
        </form>
    </div>
</div>