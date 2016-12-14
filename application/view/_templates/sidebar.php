<div class="page-container chat-visible">
	<?php
		$user = UserModel::user();
		$sidebar = isset($user->user_sidebaropen) ? $user->user_sidebaropen : 0;
    ?>
    <?php if ($sidebar == 0) { ?>
        <div class="sidebar-menu toggle-others fixed" style="width:15%">
            <div class="sidebar-menu-inner">
                <div style="padding-top: 80px;"></div>
                <ul id="main-menu" class="main-menu">
                    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                    <?php if (Session::get('id') == true): ?>
                        <li>
                            <a href="<?php echo SITE_URL; ?>">
                                <i class="fa fa-lg fa-fw fa-dashboard"></i> 
                                <span class="menu-item-parent">Home</span>
                            </a>
                            <a href="<?php echo SITE_URL; ?>dashboard/deposit">
                                <i class="fa fa-lg fa-fw fa-cc-visa"></i> 
                                <span class="menu-item-parent">Deposit/Withdraw</span>
                            </a>
                            <a href="<?php echo SITE_URL; ?>dashboard/trades/">
                                <i class="fa fa-lg fa-fw fa-line-chart"></i> 
                                <span class="menu-item-parent">Trades</span>
                            </a>
                            <a href="<?php echo SITE_URL; ?>dashboard/transactions/">
                                <i class="fa fa-lg fa-fw fa-history"></i> 
                                <span class="menu-item-parent">Transactions</span>
                            </a>
                            <a href="<?php echo SITE_URL; ?>security/security">
                                <i class="fa fa-lg fa-fw fa-lock"></i> 
                                <span class="menu-item-parent">Security</span>
                            </a>
                        <li class="active">
                            <a href="">
                                <i class="fa-line-chart"></i>
                                <span class="title"> <?php echo Filtration\Core\System::translate("Markets"); ?></span>
                            </a>
                            <ul>
                                <?php
								/*
                                $coinmarket = $this->model->site();
                                $coinmarket = explode(",", $coinmarket->coins);
                                foreach ($coinmarket as $coinlinks) {
                                    ?>

                                    <li>
                                        <a href="<?php echo SITE_URL; ?>dashboard/?market=<?php echo $coinlinks; ?>">
                                            <span class="title"> <?php echo str_replace('_', '/', $coinlinks); ?></span>
                                        </a>
                                    </li>
                                <?php } */?>
                            </ul>
                        </li>

                        
                    <?php else: ?>
                        <a href="<?php echo SITE_URL; ?>user/login">
                            <i class="fa fa-lg fa-fw fa-user"></i> 
                            <span class="menu-item-parent"><?php echo Filtration\Core\System::translate("Login"); ?></span>
                        </a>
                        <a href="<?php echo SITE_URL; ?>user/register">
                            <i class="fa fa-lg fa-fw fa-pencil"></i> 
                            <span class="menu-item-parent"><?php echo Filtration\Core\System::translate("Register"); ?></span>
                        </a>
                        <a href="<?php echo SITE_URL; ?>api">
                            <i class="fa fa-lg fa-fw fa-code"></i> 
                            <span class="menu-item-parent"><?php echo Filtration\Core\System::translate("API"); ?></span>
                        </a>
                    <?php endif; ?>

                    </li>
                </ul>
            </div>
        </div>
    <?php } ?>


    <div class="main-content col-sm-12">
        
        <?php Alert::error(Session::get('error')); ?>
        <?php Alert::success(Session::get('success')); ?>