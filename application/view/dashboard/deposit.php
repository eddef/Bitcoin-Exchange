
<div class="panel-heading">
    <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Depositing and Withdrawing"); ?></h3>
</div><!-- end panel-heading !-->
<div class="panel-body">
    <div>
        <table class="table">
            <thead>
                <tr role="row">
					<th><?php echo Filtration\Core\System::translate("Currency"); ?></th>
					<th><?php echo Filtration\Core\System::translate("Balance"); ?></th>
					<th><?php echo Filtration\Core\System::translate("Description"); ?></th>
					<th><?php echo Filtration\Core\System::translate("Actions"); ?></th>
				</tr>
            </thead>
            <tbody class="middle-align">
                <?php foreach ($this->deposit as $dcoin) { ?>
                    <tr role="row" class="odd">
                        <td><?php echo System::escape($dcoin->coin_title); ?></td>
                        <td><?php echo System::escape($this->user->{"user_".$dcoin->coin_coin}); ?></td>
                        <td><?php echo System::escape($dcoin->coin_description); ?>
                        <td>
                            <a href="<?php echo SITE_URL; ?>/transfer/withdraw/<?php echo System::escape($dcoin->coin_coin); ?>" class="btn btn-secondary btn-sm btn-icon icon-left">
                                <?php echo Filtration\Core\System::translate('Withdraw'); ?>
                            </a>
                            <a href="<?php echo SITE_URL; ?>/transfer/deposit/<?php echo System::escape($dcoin->coin_coin); ?>" class="btn btn-danger btn-sm btn-icon icon-left pull-right">
                                <?php echo Filtration\Core\System::translate('Deposit'); ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    $(function ()
    {
        $("#bitcoindecrement").click(function ()
        {
            $("input#withdrawbitcoinfee").val($("input#withdrawbitcoin").val());
        });
    });
    $(function ()
    {
        $("#bitcoinincrement").click(function ()
        {
            $("input#withdrawbitcoinfee").val($("input#withdrawbitcoin").val());
        });
    });
</script>
