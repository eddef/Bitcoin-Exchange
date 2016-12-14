<script type="text/javascript">
    CKEDITOR.replace("ckeditor");
</script>	
<div class="col-md-7 col-md-offset-3">
    <form role="form" method="post" action="<?php echo ADMINSITE_URL; ?>/insertpage">
        <div class="form-group">
            <div class="col-sm-10">
                <input name="title" type="text" class="form-control" id="field-1" placeholder="<?php echo Filtration\Core\System::translate("Enter a Page Title"); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <input name="pSITE_URL" type="text" class="form-control" id="field-1" placeholder="<?php echo Filtration\Core\System::translate("Enter a Page SITE_URL"); ?>">
            </div>
        </div>
</div>

<div class="col-md-9">
    <div class="form-group">

        <textarea id="ckeditor" name="page" class="form-control ckeditor" rows="10">
        </textarea>
        <button class="btn btn-blue btn-icon pull-right"><?php echo Filtration\Core\System::translate("Add page"); ?></button>
    </div></div>
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
