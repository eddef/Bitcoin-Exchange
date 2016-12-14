<!-- Begin page -->
<div id="wrapper" class="enlarged forced">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Ub<i class="md md-album"></i>ld</span></a>
                <!-- Image Logo here -->
                <!--<a href="index.html" class="logo">-->
                    <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                    <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                <!--</a>-->
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button class="button-menu-mobile open-left waves-effect waves-light">
                            <i class="md md-menu"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>

                    <ul class="nav navbar-nav navbar-right pull-right">       
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                        </li>
                        <li class="hidden-xs">
                            <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>
                        </li>
                        <li class="dropdown top-menu-item-xs">
                            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/guest.png" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->

<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

            	<li class="text-muted menu-title">Navigation</li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-dashboard"></i><span> Dashboard </span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SURL; ?>dashboard/deposit"> Deposit/Withdraw</a></li>
                        <li><a href="<?php echo SURL; ?>dashboard/trades"> Trades</a></li>
                        <li><a href="<?php echo SURL; ?>dashboard/transactions"> Transactions</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i><span> Account </span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SURL; ?>security/security"> Security</a></li>
                        <li><a href="<?php echo SURL; ?>user/edit/"> Edit</a></li>
                        <li><a href="<?php echo SURL; ?>user/information/"> Information</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-key"></i><span> API </span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SURL; ?>api"> Documentation</a></li>
                        <li><a href="<?php echo SURL; ?>api/api/"> My Keys</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i><span> Help</span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SURL; ?>fqq"> FAQ</a></li>
                        <li><a href="<?php echo SURL; ?>notification/messages/"> Messages</a></li>
                        <li><a href="<?php echo SURL; ?>help"> Support</a></li>
                    </ul>
                </li>
				
				<div id="usersidebar">
					<p class="header"><?php echo Filtration\Core\System::translate("Welcome back"); ?></p> 
					<p class="info" style="color:white;"><?php echo System::escape($user->user_username); ?><br><br>
						<?php if ($user->user_detailverified == 0): ?>
							<a href="<?php echo SITE_URL; ?>dashboard/verify" class="btn btn-xs btn-danger" style="width:100%; color:white;"><?php echo Filtration\Core\System::translate("Verify now!"); ?></a></p>
					<?php else: ?>
						<div class="btn btn-xs btn-success" style="width:100%"><?php echo Filtration\Core\System::translate("Verified"); ?></div></p>
					<?php endif; ?>
				</div>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->

<div class="content-page">
<!-- Start content -->
<div class="content">
    <div class="container">
