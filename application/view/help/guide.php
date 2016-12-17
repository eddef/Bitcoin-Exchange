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
                <a href="<?php echo SURL; ?>help/guide/<?php echo Filtration\Core\System::escape($guide->guide_id); ?>" class="guideurl">
					<?php echo Filtration\Core\System::escape($guide->guide_title); ?>
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
            url: $(this).attr('href'),
            success: function (data)
            {
                $('#panel-body').html(data);

            }, error: function()
            {

            }
            
        });
        return false;
    });
});
</script>
