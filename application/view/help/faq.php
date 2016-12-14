<div class="col-md-10 col-md-offset-1">
    <h1 style="font-family: Inika; font-weight: 700; "><?php echo Filtration\Core\System::translate("Frequently Asked Questions"); ?></h1>
    <div class="list-group">
        <?php foreach ($this->faqs as $faq) { ?>
            <div class="list-group-item">
                <h4 class="list-group-item-heading" style="font-family: Inika; font-weight: 700; font-size: 18px;"> 
                    <?php echo System::escape($faq->faq_title); ?>
                </h4>
                <p class="list-group-item-text">
                    <?php echo System::escape($faq->faq_faq); ?>
                </p>
            </div>

        <?php } ?>
    </div>
</div>
