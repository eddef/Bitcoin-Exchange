<section class="mailbox-env">
    <div class="row ">
        <div class="col-sm-3 mailbox-left">
            <div class="mailbox-sidebar">
                <a href="<?php echo SITE_URL; ?>support/newticket" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
                    <i class="fa fa-pencil"></i>
                    <span><?php echo Filtration\Core\System::translate("Open Ticket"); ?></span> 
                </a>
                <ul class="list-unstyled mailbox-list">
                    <li class="active"> 
                        <a href="<?php echo SITE_URL; ?>support/"><?php echo Filtration\Core\System::translate("All Tickets"); ?>
                            <span class="pull-right"><?php echo $all; ?></span> 
                        </a> 
                    </li>
                    <li> 
                        <a href="<?php echo SITE_URL; ?>support/?type=open">
                            <?php echo Filtration\Core\System::translate("Open Tickets"); ?>
                        </a> 
                    </li>
                    <li> 
                        <a href="<?php echo SITE_URL; ?>support/?type=closed">
                            <?php echo Filtration\Core\System::translate("Closed Tickets"); ?>
                        </a> 
                    </li>

                    <?php if ($this->model->isstaff() == true): ?> 
                        <li> 
                            <a href="<?php echo SITE_URL; ?>support/admin">
                                <?php echo Filtration\Core\System::translate("Admin"); ?>
                            </a> 
                        </li> 
                    <?php endif; ?>
                </ul>
                <div class="vspacer"></div>
            </div>
        </div>

        <div class="col-sm-9 mailbox-right panel">
            <table class="table">
                <thead>
                    <td>
                        <?php echo Filtration\Core\System::translate("ID"); ?>
                    </td>
                    <td>
                        <?php echo Filtration\Core\System::translate("Title"); ?>
                    </td>
                    <?php if ($this->model->isstaff() == true): ?> 
                        <td>
                            <?php echo Filtration\Core\System::translate("User"); ?>
                        </td>
                    <?php endif; ?>
                    <td>
                        <?php echo Filtration\Core\System::translate("Status"); ?>
                    </td>
                    <td>
                        <?php echo Filtration\Core\System::translate("Last update"); ?>
                    </td>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?php echo $ticket->id; ?></td>
                            <td><?php echo '<a href="' . SITE_URL . 'support/ticket/?id=' . $ticket->id . '">' . htmlspecialchars($ticket->title, ENT_QUOTES) . '</a>'; ?></td>
                            <?php if ($this->model->isstaff() == true): ?> 
                                <td><?php echo $ticket->user; ?></td>
                            <?php endif; ?>
                            <td><?php
                                if ($ticket->status == 0) {
                                    echo '<span class="label label-success">Open</span>';
                                } else {
                                    echo '<span class="label label-danger">closed</span>';
                                }
                                ?></td>
                            <td><?php echo $ticket->lastupdate; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>