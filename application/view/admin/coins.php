<div class="col-sm-12">
    <div class="btn-group pull-right m-t-15">
        <a href="<?php echo ADMIN_SITE_URL; ?>/addcoin" class="btn btn-default">Add Coin</a>
    </div>

    <h4 class="page-title">Coins</h4>
    <p class="text-muted page-title-alt">Here you can manage the markets on your exchange</p>
</div>

<div class="panel col-sm-12">
    <div class="panel-body">

        <table class="table table-bordered table-striped" id="coins-2">      
            <thead>
                <tr>
                    <th><?php echo Filtration\Core\System::translate("Coin"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Description"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Title"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Enabled"); ?></th>
                    <th><?php echo Filtration\Core\System::translate("Actions"); ?></th>
                </tr>
            </thead>

            <tbody class="middle-align">
                <?php foreach ($this->coin as $coins) { ?>
                    <tr>
                        <td><?php echo Filtration\Core\System::escape($coins->coin_coin); ?></td>
                        <td><?php echo Filtration\Core\System::escape($coins->coin_description); ?></td>
                        <td><?php echo Filtration\Core\System::escape($coins->coin_title); ?></td>
                        <td>
                            <?php
                            if ($coins->coin_enabled == 'enabled') {
								echo '<font color="green">Enabled</font>';
                            } else {
                                echo '<font color="red">Disabled</font>'; 
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo ADMIN_SITE_URL; ?>/editcoin/<?php echo Filtration\Core\System::escape($coins->coin_id); ?>" class="btn btn-info btn-sm btn-icon icon-left">
                                Edit
                            </a>
                            <a href="<?php echo ADMIN_SITE_URL;?>/deletecoin/<?php echo Filtration\Core\System::escape($coins->coin_id); ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>



