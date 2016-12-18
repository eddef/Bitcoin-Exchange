<div class="alert alert-success success_message" style="display: none"></div>
<div class="alert alert-warning error_message" style="display: none"></div>

<div class="col-sm-7 col-xs-12">   
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("User Logins"); ?></h3>
    </div>
    <div class="panel panel-body">
	    <div class="table-responsive">
	        <?php if($this->userlogins): ?>
				<table class="table table-bordered">
					<thead>
						<tr role="row">
							<th><?php echo Filtration\Core\System::translate("Date"); ?></th>
							<th><?php echo Filtration\Core\System::translate("IP Address"); ?></th>
							<th><?php echo Filtration\Core\System::translate("Status"); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->userlogins as $userlogin) { ?>
							<tr role="row" class="odd">
								<td class="sorting_1"><?php echo Filtration\Core\System::escape($userlogin->login_date); ?></td>
								<td><?php echo Filtration\Core\System::escape($userlogin->login_ip); ?></td>
								<td><?php echo Filtration\Core\System::escape($userlogin->login_status); ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php else: ?>
				<div class="alert alert-info">
					<?php echo Filtration\Core\System::translate("There have been no logins for this account"); ?>
				</div>
			<?php endif; ?>
	    </div>
	</div>
</div>

<div class="col-sm-5 col-xs-12">    
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Whitelist IP Addresses"); ?></h3>
    </div>
    <div class="panel panel-body">
        <?php echo Filtration\Core\System::translate("If you add 1 or more whitelisted IP Addresses you will not be able to login with another
									 non-whitelisted IP. You can add and remove IP addresses. It is not recommended for you
									 to use if you have a dynamic IP"); ?>
			<div class="form-group" style="margin-top:25px;">
				<form action="<?php echo SURL; ?>security/addwhitelistip" method="POST">
					<div class="input-group"> 
						<span class="input-group-btn"> 
							<button class="btn btn-info" type="submit">Add</button> 
						</span> 
						<input type="text" name="ipwhitelist" class="form-control no-left-border form-focus-info"> 
					</div>         
				</form>
			</div>

			<div>
			<?php if($this->whitelistips): ?>
				<table class="table">
					<thead>
						<tr>                                        
							<th><?php echo Filtration\Core\System::translate("Whitelisted IP"); ?></th>
							<th><?php echo Filtration\Core\System::translate("Actions"); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$whitelistips = explode(",", $this->whitelistips);
						foreach ($whitelistips as $whitelistip) {
							if ($whitelistip > 0) {
								?>
								<tr role="row" id="ip-<?php echo System::escape($whitelistip); ?>" class="odd">
									<td><?php echo System::escape($whitelistip); ?> </td>
									<td>
										<a href="<?php echo SURL; ?>security/deleteipwhitelist/<?php echo System::escape($whitelistip); ?>" id="<?php echo System::escape($whitelistip); ?>" class="btn btn-danger remove btn-sm btn-icon icon-left"><?php echo Filtration\Core\System::translate("Delete"); ?></a>
									</td>
								</tr>
							<?php
							}
						}
						?>
					</tbody>
				</table>
			<?php else: ?>
				<div class="alert alert-info">
					<?php echo Filtration\Core\System::translate("You have no whitelisted IPs."); ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
    </div>
</div>
<script>
$(function()
{
	$('.remove').on("click", function()
	{
		var ip = $(this).attr('id');

		$.ajax({
			url: $(this).attr('href'),
			success: function(data)
			{
				if(data.success)
				{
					$('#ip-'+ip).remove('');
					$('.success_message').html(data.success + alert_close).show();
				}
				else
				{
					$('.error_message').html(data.error + alert_close).show();
				}
			}
		});
		return false;
	});
});
</script>