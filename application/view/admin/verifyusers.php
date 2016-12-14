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
				null
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
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Users Needing Verification"); ?></h3>
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
            <th><?php echo Filtration\Core\System::translate("Email"); ?></th>
            <th><?php echo Filtration\Core\System::translate("First Name"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Last Name"); ?></th>
            <th><?php echo Filtration\Core\System::translate("Actions"); ?></th>

            </tr>
            </thead>
            <tbody class="middle-align">
                <?php foreach ($this->users as $user) { ?>
                    <tr role="row" class="odd">
                        <td class="sorting_1">
                            <div class="cbr-replaced">
                                <div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div>
                                <div class="cbr-state"><span></span></div>
                            </div>
                        </td>
                        <td><?php echo System::escape($user->user_id); ?></td>
                        <td><?php echo System::escape($user->user_email); ?></td>
                        <td><?php echo System::escape($user->user_firstname); ?></td>
                        <td><?php echo System::escape($user->user_lastname); ?></td>
                        <td>
                            <a href="<?php echo ADMIN_SITE_URL; ?>/edituser/<?php echo System::escape($user->user_id); ?>" class="btn btn-secondary btn-sm btn-icon icon-left">
                                View User
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>  
</div>  