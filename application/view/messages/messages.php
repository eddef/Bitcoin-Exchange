<section class="mailbox-env">
    <div class="row">
        <!-- Inbox emails -->
        <div class="col-sm-12 col-xs-12 mailbox-right">
            <div class="mail-env">
                <!-- mail table -->
                <table class="table mail-table">
                    <!-- email list -->
                    <tbody>
                        <?php foreach ($this->messages as $message) { ?>
                            <tr class="<?php echo $message->messageread; ?>">
                                <td class="col-cb">
                                    
                                </td>
                                <td class="col-name">
                                    <a href="#" class="star">
                                        <i class="fa-star-empty"></i>
                                    </a>
                                    <a href="<?php echo SITE_URL; ?>notification/view/<?php echo System::escape($message->message_id); ?>" class="col-name"><?php echo System::escape($message->message_whofrom); ?></a>
                                </td>
                                <td class="col-subject">
                                    <a href="<?php echo SITE_URL; ?>notification/view/<?php echo System::escape($message->message_id); ?>">
                                        <?php echo System::escape($message->message_title); ?>
                                    </a>
                                </td>
                                <td class="col-options hidden-sm hidden-xs"></td>
                                <td class="col-time"><?php echo System::escape($message->message_date); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>