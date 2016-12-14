<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Deposit"); echo ' ' . $market; ?></h3>
    </div>
    <div class="panel-body">

        <?php
        switch (strtolower($market)):
            case 'usd':
                echo '
	   <div class="col-sm-4 col-sm-offset-4">
	   <form  method="post" action="https://www.okpay.com/process.html" target="_blank">
	   <input type="hidden" name="ok_receiver" value="OK896242887"/>
	   <input type="hidden" name="ok_item_1_name" value="'SITE_NAME.' Deposit ' . $user->id . '"/>
	   <input type="hidden" name="ok_item_1_type" value="donation">
	   <input type="hidden" name="ok_currency" value="USD"/>
	   <input type="hidden" name="ok_fees" value="1"/>
	   <!-- Do not edit this unless you want someone else to get your payment!-->
	   <input type="hidden" name="ok_item_1_custom_1_value" value="' . $user->username . '"/>
	   <input type="hidden" name="invoice" value="' . uniqid() . '"/>
	   <input type="image" name="submit" alt="OKPAY Payment" src="https://dev.okpay.com/img/buttons/en/buy/b23b186x54en.png"/>
	</form>
    </div>';
                break;
            case 'gbp':
                echo '
	   <div class="col-sm-4 col-sm-offset-4">
	   <form  method="post" action="https://www.okpay.com/process.html" target="_blank">
	   <input type="hidden" name="ok_receiver" value="OK896242887"/>
	   <input type="hidden" name="ok_item_1_name" value="'.SITE_NAME.' Deposit #' . $user->id . '"/>
	   <input type="hidden" name="ok_item_1_type" value="donation">
	   <input type="hidden" name="ok_currency" value="GBP"/>
	   <input type="hidden" name="ok_fees" value="1"/>
	   <!-- Do not edit this unless you want someone else to get your payment!-->
	   <input type="hidden" name="ok_item_1_custom_1_value" value="' . $user->username . '"/>
	   <input type="hidden" name="invoice" value="' . uniqid() . '"/>
	   <input type="image" name="submit" alt="OKPAY Payment" src="https://dev.okpay.com/img/buttons/en/buy/b23b186x54en.png"/>
	</form>
    </div>';
                break;
            case 'eur':
                echo '
	   <div class="col-sm-4 col-sm-offset-4">
	   <form  method="post" action="https://www.okpay.com/process.html" target="_blank">
	   <input type="hidden" name="ok_receiver" value="OK896242887"/>
	   <input type="hidden" name="ok_item_1_name" value="'.SITE_NAME.' Deposit #' . $user->id . '"/>
	   <input type="hidden" name="ok_item_1_type" value="donation">
	   <input type="hidden" name="ok_currency" value="EUR"/>
	   <input type="hidden" name="ok_fees" value="1"/>
	   <!-- Do not edit this unless you want someone else to get your payment!-->
	   <input type="hidden" name="ok_item_1_custom_1_value" value="' . $user->username . '"/>
	   <input type="hidden" name="invoice" value="' . uniqid() . '"/>
	   <input type="image" name="submit" alt="OKPAY Payment" src="https://dev.okpay.com/img/buttons/en/buy/b23b186x54en.png"/>
	</form>
    </div>';
                break;
        endswitch;
        ?>

        <p></p>
        
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo Filtration\Core\System::translate("Transaction ID"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Date"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deposits as $r) { ?>
                    <tr>
                        <td><?php echo System::escape($r->txid); ?></td>
                        <td><?php echo System::escape($r->amount); ?></td>
                        <td><?php echo System::escape( $r->date); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>