<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Withdraw"); ?></h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo SITE_URL; ?>coins/withdraw" Method="GET">
            <input type="hidden" name="coin" value="<?php echo System::escape($this->market); ?>">
            <div class="col-sm-4 col-xs-12">
                <p>
                    <?php echo Filtration\Core\System::translate('Withdraw your').' '. $this->market; ?><br/>
                    <b><?php echo Filtration\Core\System::translate("Total Balance"); ?>:</b>
                    <?php echo number_format($this->user->{"user_".system::escape($this->market)}, 6); ?><br/>
                    <b><?php echo Filtration\Core\System::translate("Minimum withdrawal:"); ?></b> 0.0003
                </p>
            </div>
            <div class="col-sm-8 col-xs-12">

                <p>
                    <div class="input-group">
                        <span class="input-group-btn"> 
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?php echo Filtration\Core\System::translate("Payees"); ?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-info no-spacing">
                                <li>
                                    <a href="<?php echo SITE_URL; ?>transfer/payees">
                                        <?php echo Filtration\Core\System::translate("Manage Payees"); ?>
                                    </a>
                                </li>
                                <?php foreach ($this->payees as $payee): ?>
                                    <li>
                                        <a onclick="add_payee('<?php echo System::escape($payee->address_address); ?>')" class="linkaddress" href="#">
                                            <?php echo System::escape($payee->address_name); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </span>
                        <input type="text" id="address" name="wallet" class="form-control no-left-border form-focus-blue">
                    </div>
                </p>
                
                <p>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo Filtration\Core\System::translate("Amount"); ?></span>
                        <input type="text" id="amount" name="amount" class="form-control">
                    </div>
                </p>

                <p>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo Filtration\Core\System::translate("Fee"); ?></span>
                        <input type="text" id="fee" disabled value="0.0002" class="form-control">
                    </div>
                </p>

                <p>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo Filtration\Core\System::translate("Total"); ?></span>
                        <input type="text" disabled id="total" value="" class="form-control">
                    </div>
                </p>

                <p class="tandc">
                    IMPORTANT NOTE: Please ensure that all information given above is accurate and complete as any error or incomplete information may result in the transaction being delayed, lost or not being processed. We accept no responsibility for any loss or damage suffered by any person arising out of this transaction.
                </p>

                <div class="form-submit col-md-offset-1 col-md-10 pull-right">
                    <input class="btn btn-success pull-right" type="submit" value="Submit">
                </div>
            </div>
        </form>
    </div>

    <?php if($this->withdraw): ?>
        <table class="table">
            <thead>
                <tr role="row">
                    <th><?php echo Filtration\Core\System::translate("Address"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Transaction ID"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Date"); ?></th>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->withdraw as $r) { ?>
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
        <div class="alert alert-info">
            <?php echo Filtration\Core\System::translate("You have not withdrawn any coins"); ?>
        </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    function CopyToClipboard()
    {
        document.getElementById('wallet').focus();
        document.getElementById('wallet').select();
    }
    function add_payee(a) {
        $('#address').val(a)
    }
    jQuery(document).ready(function ($)
    {
        $('.linkaddress').click(function (e) {
            e.preventDefault();
        });
        $('#amount').keyup(function ()
        {
            var total = $('#amount').val() - $('#fee').val();
            if (isNaN(total) == true)
            {
                var total = 0;
            }
            if (typeof total != 'undefined')
            {
                $('#total').val(total)
            }
        });
    });
</script>