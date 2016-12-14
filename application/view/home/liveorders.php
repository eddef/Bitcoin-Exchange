<?php 
use Filtration\Core\System; 
?>
<div class="col-sm-4 col-xs-12 col-sm-offset-1">
    <!-- Live Ask  -->
    <strong><?php echo Filtration\Core\System::translate("Trades"); ?></strong>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><?php echo Filtration\Core\System::translate("Market"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Buy/Sell"); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->trademarket as $trade) { ?>
                <tr>
                    <td><?php echo System::escape($trade->trade_market); ?></td>
                    <td><?php echo System::escape($trade->trade_amount); ?></td>
                    <td><?php echo System::escape($trade->trade_price); ?></td>
                    <td><?php echo ($trade->trade_buysell == "buy") ? '<font color="green">Buy</font>' : '<font color="red">Sell</font>'; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>							
</div>

<div class="col-sm-3 col-xs-12">
    <!-- Live Ask  -->
    <strong><?php echo Filtration\Core\System::translate("Ask"); ?></strong>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><?php echo Filtration\Core\System::translate("Market"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->buymarket as $buy) { ?>
                <tr>
                    <td><?php echo System::escape($buy->order_market); ?></td>
                    <td><?php echo System::escape($buy->order_amount); ?></td>
                    <td><?php echo System::escape($buy->order_price); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>							
</div>

<div class="col-sm-3 col-xs-12">
    <!-- Bordered + Striped Table -->
    <strong><?php echo Filtration\Core\System::translate("Sell"); ?></strong>								
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><?php echo Filtration\Core\System::translate("Market"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->sellmarket as $sell) { ?>
                <tr>
                    <td><?php echo System::escape($sell->order_market); ?></td>
                    <td><?php echo System::escape($sell->order_amount); ?></td>
                    <td><?php echo System::escape($sell->order_price); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>							
</div>
<div class="col-sm-offset-1"></div>
