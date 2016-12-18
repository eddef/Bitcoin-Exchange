<div class="col-xs-12">
    <ul class="nav nav-tabs">
        <li class="active"> <a href="#all" data-toggle="tab">All Members</a> </li>
        <li> <a href="#admin" data-toggle="tab">Administrators</a> </li>
        <li> <a href="#staff" data-toggle="tab">Staff</a> </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="all">
            <table class="table table-hover members-table middle-align">
                <thead>
                    <tr>
                        <th class="hidden-xs hidden-sm"></th>
                        <th><?php echo Filtration\Core\System::translate("Name and Role"); ?></th>
                        <th class="hidden-xs hidden-sm">E-Mail</th>
                        <th>ID</th>
                        <th><?php echo Filtration\Core\System::translate("Settings"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->users as $user) { ?>
                        <tr>
                            <td class="user-name"> 
                                <span><?php echo Filtration\Core\System::escape($user->user_role); ?></span> 
                            </td>
                            <td>
                                <a href="<?php echo ADMIN_SURL; ?>/edituser/<?php Filtration\Core\System::escape($user->user_id); ?>" class="name">
                                    <?php echo Filtration\Core\System::escape($user->user_firstname); ?> <?php echo Filtration\Core\System::escape($user->user_lastname); ?>
                                </a> 
                            </td>
                            <td class="hidden-xs hidden-sm"> 
                                <span class="email"><?php echo Filtration\Core\System::escape($user->user_email); ?></span> 
                            </td>
                            <td class="user-id">
                                <?php echo Filtration\Core\System::escape($user->user_id); ?>
                            </td>
                            <td class="action-links"> 
                                <?php if (Filtration\Model\UserModel::user_role('admin') == true): ?>
                                    <a href="<?php echo ADMIN_SURL; ?>/edituser/<?php echo Filtration\Core\System::escape($user->user_id); ?>" class="edit"> 
                                        <i class="fa fa-pencil"></i> Edit Profile
                                    </a>
                                    <a href="<?php echo ADMIN_SURL; ?>/deleteuser/<?php echo Filtration\Core\System::escape($user->user_id); ?>" class="delete"> 
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                <?php elseif (UserModel::user_role('staff') == true): ?>
                                    <a href="<?php echo ADMIN_SURL; ?>/edituser/<?php echo Filtration\Core\System::escape($user->user_id); ?>" class="delete"> 
                                        <i class="fa fa-pencil"></i> View user
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>