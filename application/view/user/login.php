<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class=" card-box">
    <div class="panel-heading"> 
        <h3 class="text-center"><?php echo Filtration\Core\System::translate("Login form"); ?></h3>
    </div> 


    <div class="panel-body">
    <div class="alert alert-success" id="success_message" style="display: none"></div>
    <div class="alert alert-warning" id="error_message" style="display: none"></div>
    <form class="form-horizontal m-t-20" id="login-form" action="<?php echo SURL; ?>user/login_action" method="post">
        
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text" name="mail" required="" placeholder="<?php echo Filtration\Core\System::translate("Email"); ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" name="password" required="" placeholder="<?php echo Filtration\Core\System::translate("Password"); ?>">
                <div id="capslock" style="visibility:hidden">
                    <font color="red">
                        <br><?php echo Filtration\Core\System::translate("Your caps lock is enabled. Our passwords are case-sensitive."); ?>
                    </font>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <div class="col-xs-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox">
                    <label for="checkbox-signup">
                        <input name="rememberme" type="checkbox">
                        <?php echo Filtration\Core\System::translate("Remember Me"); ?>
                    </label>
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
                <?php echo Filtration\Core\System::translate("Don't have an account?"); ?>
                <a href="<?php echo SURL; ?>user/register" class="text-primary m-l-5">
                    <b><?php echo Filtration\Core\System::translate("Sign Up"); ?></b>
                </a>
            </p>
                
            </div>
    </div>
    
</div>