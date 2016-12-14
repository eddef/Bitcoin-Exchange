<script type="text/javascript">
    CKEDITOR.replace("ckeditor");
</script>	
<div class="col-md-9">

    <form role="form" action="<?php echo ADMINSITE_URL; ?>/updatenews/" method="POST">

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <textarea id="ckeditor" name="message" class="form-control ckeditor" rows="10">
                <?php echo $editnews->message; ?>
            </textarea>

        </div>
        <button class="btn btn-blue btn-icon pull-right"><?php echo Filtration\Core\System::translate("Update FAQ"); ?></button>
    </form>
</div>
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

