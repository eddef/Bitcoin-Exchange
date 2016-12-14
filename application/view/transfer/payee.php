<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Manage Payees"); ?></h3>
    </div>
    <div class="panel-body">
        
        <form action="" method="POST">
            <input type="hidden" name="add_payee" value="1">
            <div class="col-xs-12">

                <p>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo Filtration\Core\System::translate("Payee Address"); ?></span>
                        <input type="text" id="address" name="address" class="form-control">
                    </div>
                </p>

                <p>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo Filtration\Core\System::translate("Payee Name"); ?></span>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                </p>
                
                <p>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo Filtration\Core\System::translate("Coin Type"); ?></span>
                        <select name="coin" class="form-control">
                            <option value="Bitcoin">Bitcoin</option>
                            <option value="Litecoin">Litecoin</option>
                        </select>
                    </div>
                </p>

                <p class="tandc">
                    <?php echo Filtration\Core\System::translate("IMPORTANT NOTE: Please ensure that all information given above is accurate and complete as any error or incomplete information may result in the transaction being delayed, lost or not being processed. We accept no responsibility for any loss or damage suffered by any person arising out of this transaction."); ?>
                </p>

                <input class="btn btn-success pull-right" type="submit" value="<?php echo Filtration\Core\System::translate("Add Payee"); ?>">
            </div>
        </form>
    </div>
    <?php if(!empty($this->payees)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo Filtration\Core\System::translate("Address"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Payee Name"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Coin"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->payees as $payee) { ?>
                    <tr>
                        <td><?php echo System::escape($payee->address); ?></td>
                        <td><?php echo System::escape($payee->name); ?></td>
                        <td><?php echo System::escape($payee->coin); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">
            <?php echo Filtration\Core\System::translate("You currently have no payee addresses. Please add one with the form above."); ?>
        </div>
    <?php endif; ?>
</div>
