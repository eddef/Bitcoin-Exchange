<div class="col-sm-9"> 
    <div class="panel panel-default">
        <div class="panel-heading"> <h3 class="panel-title"> User Guides </h3>
            
		</div>
		<div id="panel-body" class="panel-body"> 
        </div>
	</div>
</div>

<div class="col-sm-3">
    <ul class="list-group list-group-minimal">
        <?php foreach ($this->guides as $guide) { ?>							
            <li class="list-group-item">
                <span class="badge badge-roundless badge-primary"></span>
                <a href="<?php echo SITE_URL.'help/guide/'.System::escape($guide->userguide_url); ?>" class="guideurl">
					<?php echo System::escape($guide->userguide_title); ?>
            </li>
        <?php } ?>
    </ul>
</div>

<script>
$(document).ready(function () 
{
    $(".guideurl").on("click", function () 
    {
        $.ajax({
            type: 'GET',
            URL: $(this).attr('href'),
            success: function (msg) 
            {
                $('#panel-body').html(msg);
            }
        });
        return false;
    });
});
</script>
