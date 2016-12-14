<section class="profile-env">
    <div class="col-md-12">
        <ul class="cbp_tmtimeline">
            <?php foreach ($this->timeline as $r) { ?>
                <li>
                    <time class="cbp_tmtime" datetime="<?php echo $r->time; ?>">
                        <span><?php echo System::escape($r->trade_time); ?></span>
                    </time>
                    <div class="cbp_tmicon timeline-bg-success">
                        <i class="fa-calendar"></i>
                    </div>
                    <div class="cbp_tmlabel">
                        <?php
                            if ($r->trade_buysell == "buy") {
                                $buysell = "Bought ";
                            } else {
                                $buysell = "Sold ";
                            }
                        ?>
                        <?php echo Filtration\Core\System::translate("You"); ?>
                        <?php echo System::escape($buysell); ?>
                        <?php echo System::escape($r->trade_amount); ?>
                        <?php echo System::escape($r->trade_market); ?>
                        <?php echo Filtration\Core\System::translate("totalling"); ?>
                        <?php echo System::escape($r->trade_cost); ?> USD 
                        <?php echo Filtration\Core\System::translate("with an I.P (internet protocol) address of"); ?>
                        <?php echo System::escape($r->trade_ip); ?>
                    </div>
                </li>
                <?php }if (count($this->timeline <= 0)) {
                    ?>
                    <li>
                        <time class="cbp_tmtime" datetime="2014-10-03T18:30"><span class="hidden">03/10/2014</span> <span class="large">Now</span></time>
                        <div class="cbp_tmicon timeline-bg-gray">
                            <i class="fa-user"></i>
                        </div>
                        <div class="cbp_tmlabel empty">
                            <span><?php echo Filtration\Core\System::translate("You have not completed any trades yet."); ?></span>
                        </div>
                    </li>
                <?php } ?>
            </div>
        </li>
    </ul>
</div>
