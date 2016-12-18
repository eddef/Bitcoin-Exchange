<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">

    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center">
                <?php echo Filtration\Core\System::translate("Sign Up"); ?>
            </h3>
        </div>


        <div class="panel-body">
            <div class="alert alert-success" id="success_message" style="display: none"></div>
            <div class="alert alert-warning" id="error_message" style="display: none"></div>
            <form class="form-horizontal m-t-20" id="register-form" action="<?php echo SURL; ?>user/register_action" method="post">

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" name="username" placeholder="<?php echo Filtration\Core\System::translate("Username"); ?>"/>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" name="email" placeholder="<?php echo Filtration\Core\System::translate("Email"); ?>"/>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="password" class="form-control" name="password" placeholder="<?php echo Filtration\Core\System::translate("Password"); ?>"/>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="password" class="form-control" data-validate="required,equalTo[#password]" data-message-equal-to="<?php echo Filtration\Core\System::translate("Password don't match"); ?>" name="password2" placeholder="<?php echo Filtration\Core\System::translate("Password confirm"); ?>"/>
                    </div>
                </div>

                <p class="text-center">
                    <b><?php echo Filtration\Core\System::translate("Password Requirements"); ?></b>
                </p>
               
                <br />
                
                <div class="row small-row">
                    <div class="col-xs-6">
                        <ul>
                            <li><?php echo Filtration\Core\System::translate("8 characters minimum"); ?></li>
                            <li><?php echo Filtration\Core\System::translate("1 or more upper-case letters"); ?></li>
                        </ul>
                    </div>
                    <div class="col-xs-6">
                        <ul>
                            <li><?php echo Filtration\Core\System::translate("1 or more lower-case letters"); ?></li>
                            <li><?php echo Filtration\Core\System::translate("1 or more digits or special characters"); ?></li>
                        </ul>
                    </div>
                </div>
                <p class="text-center">
                    <?php echo Filtration\Core\System::translate("These security questions will not be changeable or visible after registration.
            If you lose access to your email/account, we will use these questions as part of the process to grant access to your account."); ?>               
                 </p>
                 <br />

    
            <div class="col-xs-6">
                <select name="securityq1" id="securityq1" class="form-control">
                    <option value="<?php echo Filtration\Core\System::translate("Favourite Sports Team"); ?>">
                        <?php echo Filtration\Core\System::translate("Favorite Sports Team"); ?>
                    </option>
                    <option value="<?php echo Filtration\Core\System::translate("Favourite Food"); ?>">
                        <?php echo Filtration\Core\System::translate("Favorite Food"); ?>
                    </option>
                    <option value="<?php echo Filtration\Core\System::translate("Mother's Maiden Name "); ?>">
                        <?php echo Filtration\Core\System::translate("Mother's Maiden Name"); ?>
                    </option>
                    <option value="<?php echo Filtration\Core\System::translate(" Grandmother 's BirthPlace"); ?>">
                        <?php echo Filtration\Core\System::translate("Grandmothers BirthPlace"); ?>
                    </option>
                    <option value="<?php echo Filtration\Core\System::translate("Father's Name "); ?>">
                        <?php echo Filtration\Core\System::translate("Father's Name"); ?>
                    </option>
                </select><br/>
            </div>

            <div class="col-xs-6">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="linecons-lock"></i>
                    </div>
                    <input type="text" class="form-control" data-validate="required" id="securitya1" name="securitya1" placeholder="<?php echo Filtration\Core\System::translate(" Security Question Answer "); ?>"/>
                </div> <br/>
            </div>
                     

            <div class="col-xs-6">
                <select name="securityq2" id="securityq2" class="form-control">
                    <option value="<?php echo Filtration\Core\System::translate("What was the name of your Elementary School"); ?>">
                        <?php echo Filtration\Core\System::translate("What was the name of your Elementary School"); ?>    
                    </option>
                    <option value="<?php echo Filtration\Core\System::translate("Favorite Movie"); ?>">
                        <?php echo Filtration\Core\System::translate("Favourite Movie"); ?>    
                    </option>
                    <option value="<?php echo Filtration\Core\System::translate("Mother's Maiden Name"); ?>">
                        <?php echo Filtration\Core\System::translate("Mother's Maiden Name"); ?>
                    </option>
                    <option value="<?php echo Filtration\Core\System::translate("Grandmother's BirthPlace"); ?>">
                        <?php echo Filtration\Core\System::translate("Grandmother's BirthPlace"); ?>
                    </option>
                    <option value="<?php echo Filtration\Core\System::translate("Father's Name"); ?>">
                        <?php echo Filtration\Core\System::translate("Father's Name"); ?>
                    </option>
                </select>
            </div>
                        
            <div class="col-xs-6">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="linecons-lock"></i>
                    </div>
                    <input type="text" name="securitya2" id="securitya2" data-validate="required" class="form-control" placeholder="<?php echo Filtration\Core\System::translate("Security Question Answer"); ?>"/>
                </div>
            </div>
                

        <div class="form-group ">
            <div class="col-xs-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox">
                    <label for="checkbox-signup">
                        <input type="checkbox" name="terms" value="" id="terms" data-validate="required">
                        <?php echo Filtration\Core\System::translate("I agree to"); ?>
                    </label>
                     <a href="<?php echo SITE_URL; ?>pages/?id=tos">
                        <?php echo Filtration\Core\System::translate("Terms and Conditions"); ?>
                    </a>
                </div>

            </div>
        </div>

        <div class="form-group text-center m-t-40">
            <div class="col-xs-12">
                <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">
                    <?php echo Filtration\Core\System::translate("Sign in"); ?>
                </button>
            </div>
        </div>

        <div class="form-group m-t-30 m-b-0">
            <div class="col-sm-12">
                <a href="<?php echo SURL; ?>user/passreset" class="text-dark">
                    <i class="fa fa-lock m-r-5"></i>
                    <?php echo Filtration\Core\System::translate("Forgot Password"); ?>
                </a>
            </div>
        </div>
        </form>

    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center">
        <p>
            <?php echo Filtration\Core\System::translate("Have an account?"); ?>
            <a href="<?php echo SURL; ?>user/login" class="text-primary m-l-5">
                <b><?php echo Filtration\Core\System::translate("Sign In"); ?></b>
            </a>
        </p>

    </div>
</div>

</div>
