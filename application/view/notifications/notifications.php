<section class="mailbox-env">
    <div class="row">
        <!-- Inbox emails -->
        <div class="col-sm-12 col-xs-12 mailbox-right">
            <div class="mail-env">
                <?php if(empty($this->notifications)){ ?>
                    <div class="alert alert-info">
                        <?php echo Filtration\Core\System::translate("No notifications to show"); ?>
                    </div>
                <?php }else{ ?>
                    <table class="table mail-table">
                        <!-- email list -->
                        <tbody>
                            <?php foreach ($this->notifications as $notification) { ?>
                                <tr class="<?php echo $notification->notification_read; ?>">
                                    <td class="col-cb">
                                        
                                    </td>
                                    <td class="col-name">
                                        <a href="#" class="star">
                                            <i class="fa-star-empty"></i>
                                        </a>
                                        <a href="<?php echo SURL; ?>notification/view/<?php echo System::escape($notification->notification_id); ?>" class="col-name"><?php echo System::escape($notification->notification_whofrom); ?></a>
                                    </td>
                                    <td class="col-subject">
                                        <a href="<?php echo SURL; ?>notification/view/<?php echo System::escape($notification->notification_id); ?>">
                                            <?php echo System::escape($notification->notification_title); ?>
                                        </a>
                                    </td>
                                    <td class="col-options hidden-sm hidden-xs"></td>
                                    <td class="col-time"><?php echo System::escape($notification->notification_date); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</section>