
<div class="panel-heading">
    <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Completed trades"); ?></h3>
</div>
<div class="panel-body">
    <script type="text/javascript">
        jQuery(document).ready(function ($)
        {
            $("#trades").dataTable({
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo SITE_URL; ?>js/datatables/tabletools/copy_csv_xls_pdf.swf"
                }
            });
        });
    </script>

    <div>
        <?php if($this->trades): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo Filtration\Core\System::translate("Market"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Amount"); ?>
                        <th><?php echo Filtration\Core\System::translate("Cost"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Time"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Buy Or Sell"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Date"); ?><//th>
                        <th><?php echo Filtration\Core\System::translate("Invoice"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->trades as $r) { ?>     
                        <tr>
                            <td><?php echo System::escape($r->trade_market); ?></td>
                            <td><?php echo System::escape($r->trade_amount); ?></td>
                            <td><?php echo System::escape($r->trade_cost); ?></td>
                            <td><?php echo System::escape($r->trade_price); ?></td>
                            <td><?php echo System::escape($r->trade_time); ?></td>
                            <td><?php echo System::escape($r->trade_buysell); ?></td>
                            <td><?php echo System::escape($r->trade_date); ?></td>
                            <td>                            
                                <a href="<?php echo SITE_URL; ?>dashboard/invoice/<?php echo System::escape($r->trade_id); ?>" class=" viewinvoicebtn btn-success btn-sm btn-icon icon-left">
                                    <?php echo Filtration\Core\System::translate("View Invoice"); ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">
                <?php echo Filtration\Core\System::translate("You have not completed any trades."); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
