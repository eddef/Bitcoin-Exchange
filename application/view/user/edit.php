<section class="profile-env">

    <div class="alert alert-success success_message" style="display: none"></div>
    <div class="alert alert-warning error_message" style="display: none"></div>

    <div class="col-md-12 ">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Edit Information"); ?></h3>
            </div>
            <div class="panel-body">

                <div class="row col-margin">
                    <form action="<?php echo SURL; ?>user/editinformation/" method="POST" id="update_profile">
                        <div class="col-xs-12 col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="linecons-mail"></i>
                                </div>
                                <input type="text" class="form-control" name="email" id="email" data-validate="required" value="<?php echo Filtration\Core\System::escape($this->user->user_email); ?>" data-message-required="<?php echo Filtration\Core\System::translate("Please enter an email address"); ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="linecons-lock"></i>
                                    </div>

                                    <input type="password" class="form-control" name="password" id="password" data-validate="required" placeholder="<?php echo Filtration\Core\System::translate("Enter strong password"); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="linecons-lock"></i>
                                    </div>

                                    <input type="password" class="form-control" name="passwordconf" id="passwordconf" data-validate="required,equalTo[#password]" data-message-equal-to="<?php echo Filtration\Core\System::translate(" Passwords don 't match"); ?>" placeholder="<?php echo Filtration\Core\System::translate("Confirm password"); ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <p class="text-center">
                        <b><?php echo Filtration\Core\System::translate("Password Requirements"); ?></b>
                    </p>
                    <br>
                    <div class="row small-row">
                        <div class="col-xs-12 col-sm-3">
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <ul>
                                <li>
                                    <?php echo Filtration\Core\System::translate("8 characters minimum"); ?>
                                </li>
                                <li>
                                    <?php echo Filtration\Core\System::translate("1 or more upper-case letters"); ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <ul>
                                <li><?php echo Filtration\Core\System::translate("1 or more lower-case letters"); ?></li>
                                <li><?php echo Filtration\Core\System::translate("1 or more digits or special characters"); ?></li>
                            </ul>
                        </div>
                        <div class="col-xs-3"></div>
                    </div>
                    <div class="member-form-inputs">
                        <div class="row">
                            <div class="col-xs-6">
                                <label class="col-sm-6 control-label"><?php echo Filtration\Core\System::translate("Don't show sidebar"); ?></label>
                                <div class="col-sm-6">
                                    <div class="form-block">
                                        <input id="expandedsidebar" value="" name="expandedsidebar" 
                                            <?php if ($this->user->user_sidebaropen == 1) { echo 'checked '; } ?> 
    										type="checkbox" class="iswitch iswitch-secondary ">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <label class="col-sm-6 control-label "><?php echo Filtration\Core\System::translate("Email on login"); ?></label>
                                <div class="col-sm-6 ">
                                    <div class="form-block">
                                        <input id="loginnotify" value="" name="loginnotify" <?php
                                        if ($this->user->user_loginnotify == 'enabled') {
                                            echo 'checked ';
                                        }
                                        ?> type="checkbox" class="iswitch iswitch-secondary">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <label class="col-sm-6 control-label"><?php echo Filtration\Core\System::translate("Email on withdraw"); ?></label>
                                <div class="col-sm-6">
                                    <div class="form-block">
                                        <input id="emailonwithdraw" value="" name="notifywithdraw" <?php
                                        if ($this->user->user_withdrawnotify == 'enabled') {
                                            echo 'checked ';
                                        }
                                        ?> type="checkbox" class="iswitch iswitch-secondary">
                                    </div>
                                </div>
                            </div>
                            <?php if(VOICE_COMMANDS == 'enabled'): ?>
                                <div class="col-xs-6">
                                    <label class="col-sm-6 control-label"><?php echo Filtration\Core\System::translate("Enable Voice Commands"); ?></label>
                                    <div class="col-sm-6">
                                        <div class="form-block">
                                            <input id="voicetrading" value="" name="voicecommands" <?php
                                            if ($this->user->user_voicecommands == 'enabled') {
                                                echo 'checked ';
                                            }
                                            ?> type="checkbox" class="iswitch iswitch-secondary">
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" id="submit" name="submit" class="btn btn-danger pull-right">
                            <?php echo Filtration\Core\System::translate("Update"); ?>
                        </button><br/><br/>
                    </div>
                </form>
                </label>
                
                <hr>
                <div class="member-form-inputs ">
                    <div class="row ">
                        <div class="col-sm-3 ">
                            <label class="control-label" for="username"><?php echo Filtration\Core\System::translate("Account security"); ?></label>
                        </div>
                        <tr>
                            <td width="15% ">
                                <a href="<?php echo SURL; ?>user/twofactor" class="btn btn-success">
                                    <?php echo Filtration\Core\System::translate("Enable 2factor"); ?>
                                </a>
                            </td>
                        </tr>
                    </div>
                </div>
                </p>
            </div>
        </div>
    </div>

<script>
$(document).ready(function ()
{
    $('#update_profile').on("submit", function ()
    {
        $.ajax(
        {
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data)
            {

                if(data.success)
                {
                    $('.success_message').html(data.success).show();
                }
                else
                {
                    $('.error_message').html(data.error).show();
                }
            }
        });

        return false;
    });
});
</script>