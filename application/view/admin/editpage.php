<script type="text/javascript">
    CKEDITOR.replace("ckeditor");
</script>	
<div class="col-md-9">

    <form role="form" action="<?php echo ADMINSURL; ?>/updatepage/" method="POST">

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <textarea id="ckeditor" name="message" class="form-control ckeditor" rows="10">
                <?php echo $editpage->body; ?>
            </textarea>

        </div>
        <button class="btn btn-blue btn-icon pull-right"><?php echo Filtration\Core\System::translate("Update page"); ?></button>
    </form>
</div>
<link rel="stylesheet" href="<?php echo SURL; ?>js/wysihtml5/src/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="<?php echo SURL; ?>js/uikit/vendor/codemirror/codemirror.css">
<link rel="stylesheet" href="<?php echo SURL; ?>js/uikit/uikit.css">
<link rel="stylesheet" href="<?php echo SURL; ?>js/uikit/css/addons/uikit.almost-flat.addons.min.css">
<script src="<?php echo SURL; ?>js/wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="<?php echo SURL; ?>js/uikit/vendor/codemirror/codemirror.js"></script>
<script src="<?php echo SURL; ?>js/uikit/vendor/marked.js"></script>
<script src="<?php echo SURL; ?>js/uikit/js/uikit.min.js"></script>
<script src="<?php echo SURL; ?>js/uikit/js/addons/htmleditor.min.js"></script>
<script src="<?php echo SURL; ?>js/ckeditor/ckeditor.js"></script>
<script src="<?php echo SURL; ?>js/ckeditor/adapters/jquery.js"></script>

