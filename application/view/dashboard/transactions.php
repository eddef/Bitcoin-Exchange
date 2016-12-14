<div class="panel-heading">
    <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Transactions"); ?></h3>
</div>
<div class="panel-body">
    <div class="table-responsive">
        <?php if(!empty($this->transactions)): ?>
            <table class="table">
                <thead>
                <th><?php echo Filtration\Core\System::translate("Type"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Address"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Transaction ID"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Date"); ?></th>
                </th>

                </thead>
                <tbody>
                    <?php foreach ($this->transactions as $r) { ?>     
                        <tr>
                            <td nowrap>
                                <?php
                                    if ($r->transaction == 'deposit') {
                                        echo '<font color="green">' . ucwords(System::escape($r->trade_transaction)) . '</font>';
                                    } else {
                                        echo '<font color="red">' . ucwords(System::escape($r->trade_transaction)) . '</font>';
                                    }
                                ?>
                            </td>
                            <td><?php echo System::escape($r->trade_address); ?></td>
                            <td><?php echo System::escape($r->trade_txid); ?></td>
                            <td><?php echo System::escape(round($r->trade_amount, 6)); ?></td>                              
                            <td><?php echo System::escape($r->trade_date); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">
                <?php echo Filtration\Core\System::translate("You have not completed any transactions"); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

