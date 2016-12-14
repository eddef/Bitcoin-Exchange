<script type="text/javascript">
    CKEDITOR.replace("ckeditor");
</script>
<div class="alert alert-warning error_message" style="display: none"></div>
<div class="col-sm-9 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Add Guide"); ?></h3>
        </div>
        <div class="panel-body">
            <form role="form" method="post" action="<?php echo ADMI_NSITE_URL; ?>/insertguide">
                <div class="form-group">
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" id="field-1" placeholder="<?php echo Filtration\Core\System::translate("Enter a Title for user guide"); ?>">
                    </div>	
                    <div class="col-sm-10">
                        <input name="SITE_URL" type="text" class="form-control" id="field-1" placeholder="<?php echo Filtration\Core\System::translate("Enter a url for user guide"); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <textarea id="ckeditor" name="message" class="form-control ckeditor" rows="10"></textarea>
                    <button class="btn btn-blue btn-icon pull-right"><?php echo Filtration\Core\System::translate("Add User Guide"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(function()
{
    $('#addguide').on("submit", function()
    {
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(data),
            {
                if(data.success)
                {
                    location.href = "<?php echo ADMI_NSITE_URL; ?>";
                }
                else
                {
                   $('.error_message').html(data.error + alert_close).show();
                }
                $('.ajloading').hide();
            }, error: function(data)
            {
                $('.ajloading').hide();
            }
        });
        return false;
    });
});
</script>
<link rel="stylesheet" href="<?php echo SITE_URL; ?>js/wysihtml5/src/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="<?php echo SITE_URL; ?>js/uikit/vendor/codemirror/codemirror.css">
<link rel="stylesheet" href="<?php echo SITE_URL; ?>js/uikit/uikit.css">
<link rel="stylesheet" href="<?php echo SITE_URL; ?>js/uikit/css/addons/uikit.almost-flat.addons.min.css">
<script src="<?php echo SITE_URL; ?>js/wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="<?php echo SITE_URL; ?>js/uikit/vendor/codemirror/codemirror.js"></script>
<script src="<?php echo SITE_URL; ?>js/uikit/vendor/marked.js"></script>
<script src="<?php echo SITE_URL; ?>js/uikit/js/uikit.min.js"></script>
<script src="<?php echo SITE_URL; ?>js/uikit/js/addons/htmleditor.min.js"></script>
<script src="<?php echo SITE_URL; ?>js/ckeditor/ckeditor.js"></script>
<script src="<?php echo SITE_URL; ?>js/ckeditor/adapters/jquery.js"></script>
