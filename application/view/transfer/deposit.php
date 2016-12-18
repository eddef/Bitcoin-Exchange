<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Deposit"). Filtration\Core\System::escape($this->market); ?></h3>
    </div>
    <div class="panel-body">

        <div class="col-sm-4 col-sm-offset-4">
            <img src="https://www.google.com/chart?cht=qr&chs=300x300&chl=<?php echo strtolower(Filtration\Core\System::escape($this->address->address_address)); ?>%3A<?php echo Filtration\Core\System::escape($this->market); ?>">
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="input-group">
                <input type="text" value="<?php echo Filtration\Core\System::escape($this->address->address_address); ?>" id="wallet" class="form-control">
                <span class="input-group-addon">
                    <span onClick="CopyToClipboard(); return false" style="cursor: pointer; cursor: hand;">
                        <?php echo Filtration\Core\System::translate("Copy"); ?>
                    </span> 
                </span>
                <span class="input-group-addon">
                    <a href="<?php echo SURL; ?>coins/GenerateWallet?coin=btc">
                        <span onClick="CopyToClipboard(); return false" style="cursor: pointer; cursor: hand;">
                            <?php echo Filtration\Core\System::translate("New Address"); ?>
                        </span> 
                    </a>
                </span>
            </div>
        </div>
        <br/>
    </div>

    <?php if(!empty($this->deposits)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo Filtration\Core\System::translate("Address"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Transaction ID"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Date"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->deposits as $r) { ?>
                    <tr>
                        <td><?php echo System::escape($r->address); ?></td>
                        <td><?php echo System::escape($r->txid); ?></td>
                        <td><?php echo System::escape($r->amount); ?></td>
                        <td><?php echo System::escape($r->date); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info" style="margin-top:25px;">
            <?php echo Filtration\Core\System::translate("You have not deposited any currency in to your account."); ?>
        </div>
    <?php endif; ?>
</div>  
