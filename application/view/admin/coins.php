<script type="text/javascript">
	jQuery(document).ready(function ($)
	{
		$("#coins-2").dataTable(
				{
					aLengthMenu: [
						[10, 25, 50, 100, -1],
						[10, 25, 50, 100, "5"]
					]
				});
		$("#coins-1").dataTable({
			dom: "t" + "<'row'<'col-xs-6'i><'col-xs-6'p>>",
			aoColumns: [
				{bSortable: false},
				null,
				null,
				null,
				null
			],
		});


	});
</script>
<div class="panel col-sm-9">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Coins"); ?></h3>
    </div>
    <div class="panel-body">

        <table class="table table-bordered table-striped" id="coins-2">      
            <thead>
                <tr role="row">
                    <th class="no-sorting sorting_asc" rowspan="1" colspan="1" aria-label="
                        " style="width: 16px;">
            <div class="cbr-replaced">
                <div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div>
                <div class="cbr-state"><span></span></div>
            </div>
            </th>
            <th><?php echo Filtration\Core\System::translate("Coin"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Description"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Title"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Enabled"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Actions"); ?></th>

            </tr>
            </thead>
            <tbody class="middle-align">
                <?php foreach ($this->coin as $coins) { ?>
                    <tr role="row" class="odd">
                        <td class="sorting_1">
                            <div class="cbr-replaced">
                                <div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div>
                                <div class="cbr-state"><span></span></div>
                            </div>
                        </td>
                        <td><?php echo System::escape($coins->coin_coin); ?></td>
                        <td><?php echo System::escape($coins->coin_description); ?></td>
                        <td><?php echo System::escape($coins->coin_title); ?></td>
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
                            <a href="<?php echo ADMIN_SITE_URL; ?>/editcoin/<?php echo System::escape($coins->coin_id); ?>" class="btn btn-secondary btn-sm btn-icon icon-left">
                                Edit
                            </a>
                            <a href="<?php echo ADMIN_SITE_URL;?>/deletecoin/<?php echo System::escape($coins->coin_id); ?>" class="btn btn-danger btn-sm btn-icon icon-left">
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



