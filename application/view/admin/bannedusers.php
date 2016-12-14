<script type="text/javascript">
	jQuery(document).ready(function ($)
	{
		$("#users-2").dataTable(
				{
					aLengthMenu: [
						[10, 25, 50, 100, -1],
						[10, 25, 50, 100, "5"]
					]
				});
		$("#users-1").dataTable({
			dom: "t" + "<'row'<'col-xs-6'i><'col-xs-6'p>>",
			aoColumns: [
				{bSortable: false},
				null,
				null,
				null,
			],
		});

		var $state = $("#users-1 thead input[type='checkbox']");

		$("#users-1").on('draw.dt', function ()
		{
			cbr_replace();

			$state.trigger('change');
		});

		$state.on('change', function (ev)
		{
			var $chcks = $("#users-1 tbody input[type='checkbox']");

			if ($state.is(':checked'))
			{
				$chcks.prop('checked', true).trigger('change');
			}
			else
			{
				$chcks.prop('checked', false).trigger('change');
			}
		});
	});
</script>

<div class="panel col-sm-9">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Users"); ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped" id="users-2">      
            <thead>
                <tr role="row">
                    <th class="no-sorting sorting_asc" rowspan="1" colspan="1" aria-label="
                        " style="width: 16px;">
            <div class="cbr-replaced">
                <div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div>
                <div class="cbr-state"><span></span></div>
            </div>
            </th>
            <th><?php echo Filtration\Core\System::translate("Username"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Banned by"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Banned until"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Reason"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Actions"); ?></th>

            </tr>
            </thead>
            <tbody class="middle-align">
                <?php foreach ($this->bannedusers as $banneduser) { ?>
                    <tr role="row" class="odd">
                        <td class="sorting_1">
                            <div class="cbr-replaced">
                                <div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div>
                                <div class="cbr-state"><span></span></div>
                            </div>
                        </td>
                        <td><?php echo System::escape($banneduser->user_email); ?></td>
                        <td><?php echo System::escape($banneduser->user_bannedby); ?></td>
                        <td><?php echo System::escape($banneduser->user_banneduntil); ?></td>
                        <td><?php echo System::escape($banneduser->user_reason); ?></td>				  
                        <td>
                            <a href="<?php echo ADMIN_SITE_URL; ?>/unban/<?php echo System::escape($banneduser->user_id); ?>" class="btn btn-secondary btn-sm btn-icon icon-left">
                                Unban
                        </td>
                    </tr>
                <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>



