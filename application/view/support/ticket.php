<section class="mailbox-env">
    <div class="row">
        <div class="col-sm-3 mailbox-left">
            <div class="mailbox-sidebar">
                <a href="<?php echo SITE_URL; ?>support/newticket" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
                    <i class="fa fa-pencil"></i><span><?php echo Filtration\Core\System::translate("Open Ticket"); ?></span> </a>
                <ul class="list-unstyled mailbox-list">
                    <li class="active">
                        <a href="<?php echo SITE_URL; ?>support/">
                            <?php echo Filtration\Core\System::translate("All Tickets"); ?>
                            <span class="pull-right"><?php echo $all; ?></span> </a>
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
        <div class="col-sm-9 mailbox-right">
            <div class="mail-single">
                <!-- Email Title and Button Options -->
                <div class="mail-single-header">
                    <h2><?php echo htmlentities($tickets->title, ENT_QUOTES); ?>
                        <span class="badge badge-success badge-roundless pull-right upper">
                            <?php echo htmlentities($tickets->category, ENT_QUOTES); ?></span>
                        <a href="<?php echo SITE_URL; ?>support" class="go-back">
                            <i class="fa-angle-left"></i>Go Back</a></h2>
                </div>
                <div class="mail-single-info">
                    <div class="mail-single-info-user dropdown">
                        <em class="time"><?php echo htmlentities($tickets->date, ENT_QUOTES); ?></em>
                    </div>
                </div>
                <div class="mail-single-body">
                    <?php $tickets->message ?>
                </div>
            </div>
        </div>
        <?php foreach ($ticketreply as $ticket): ?>

            <div class="col-sm-9 mailbox-right">
                <div class="mail-single">
                    <div class="mail-single-info">
                        <div class="mail-single-info-user dropdown">
                            <em class="time"><?php echo htmlentities($ticket->date, ENT_QUOTES); ?></em> 
                        </div>
                    </div>
                    <div class="mail-single-body">
                        <?php $tickets->message ?>
                    </div>
                </div>
            </div>

        <?php endforeach;
        if ($tickets->status == 0):
            ?>
            <div class="col-sm-9 mailbox-right">
                <div class="form-group">
                    <form role="form" action="<?php echo SITE_URL; ?>support/reply" method="post">
                        <input type="hidden" name="check_submit" value="1">
                        <!-- you can try to change this but if you don't own the ticket it won't work, nice try. !-->
                        <input type="hidden" name="ticket" value="<?php echo $tickets->id; ?>">
                        <textarea name="message" class="form-control wysihtml5">
                            <?php
                            if ($this->model->isstaff() == true) :
                                echo '<br/><br/>Kind regards, <br/> ' . $this->model->decrypt($user->firstname) . SITE_NAME. ' Support. <br/><img src="' . SITE_URL . '/img/logo.png">';
                            endif;
                            ?> 
                        </textarea>
                </div>
                <div class="modal-footer clearfix">
                    <button type="submit" class="btn btn-primary pull-left" style="background-color: #428bca;">
                        <i class="fa fa-envelope"></i><?php echo Filtration\Core\System::translate("Submit Ticket"); ?>
                    </button>
                    
                    <?php if ($this->model->isstaff() == true): ?> 
                        <a href="<?php echo SITE_URL; ?>support/resolved?id=<?php echo $tickets->id; ?>&ticket=close" type="submit" class="btn btn-primary pull-right" style="background-color: #428bca;">
                            <i class="fa fa-tick"></i><?php echo Filtration\Core\System::translate("Ticket Resolved"); ?>
                        </a>
                    </div>
                 <?php endif; ?>
                
                </form>
            </div>
            <?php
        endif;
        if ($this->model->isstaff() == true && $tickets->status == 1):
            ?> 
            <div class="col-sm-9 mailbox-right">
                <div class="modal-footer clearfix">
                    <a href="<?php echo SITE_URL; ?>support/resolved?id=<?php echo $tickets->id; ?>&ticket=open" type="submit" class="btn btn-primary pull-right" style="background-color: #428bca;">
                        <i class="fa fa-tick"></i><?php echo Filtration\Core\System::translate("Open Ticket"); ?>
                    </a>
                </div>
            </div>
<?php endif; ?>