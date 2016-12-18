<section class="mailbox-env">
    <div class="row">
        <div class="col-sm-9 mailbox-right">
            <div class="mail-single">
                <div class="mail-single-header">
                    <h2>
                        <?php echo System::escape($this->message->message_title); ?>
                        <span class="badge badge-success badge-roundless pull-right upper">
                            <?php echo System::escape($this->message->message_type); ?>
                        </span>
                    </h2>

                    <div class="mail-single-header-options">

                        <a href="<?php echo SURL; ?>notification/delete_message/<?php echo System::escape($this->message->message_id); ?>" class="btn btn-gray btn-icon delete_message">
                            <i class="fa-trash"></i>
                        </a>
                    </div>
                </div>

                <div class="mail-single-info">
                    <div class="mail-single-info-user dropdown">
                        <a href="#" data-toggle="dropdown">
                            <span><?php echo System::escape($this->message->message_whofrom); ?></span>
                            <?php echo SITE_NAME; ?> to <span>me</span>
                            <em class="time">
                                <?php echo System::escape($this->message->message_date); ?>
                            </em>
                        </a>
                    </div>
                </div>

                <div class="mail-single-body">
                    <?php echo strip_tags($this->message->message_message, '<br><p><a><img><span><b><i>'); ?>
                </div>
            </div>
        </div>


        <div class="col-sm-3 mailbox-left">
            <div class="mailbox-sidebar">
                <ul class="list-unstyled mailbox-list">
                    <li>
                        <a href="<?php echo SURL; ?>/user/messages/">
                            <?php  echo Filtration\Core\System::translate("All"); ?>
                            <label class="label label-info pull-right">
                                <?php echo count(NotificationModel::messagecount()); ?>
                            </label>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SURL; ?>/user/messages?type=news">
                            <?php echo Filtration\Core\System::translate("News"); ?>	
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SURL ?>/user/messages?type=account">
                            <?php echo Filtration\Core\System::translate("Account"); ?>
                        </a>
                    </li>
                </ul>
                <div class="vspacer"></div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(function()
{
    $('.delete_message').on("click", function()
    {
        $('.ajloading').show();
        $.ajax({
            url: $(this).attr('href'),
            success: function(data)
            {
                if(data.success)
                {
                    location.href = "<?php echo SURL; ?>notification/messages";
                }else{
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