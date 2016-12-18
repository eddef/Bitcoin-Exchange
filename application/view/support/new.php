<section class="mailbox-env">
    <div class="row">
        <div class="col-sm-3 mailbox-left">
            <div class="mailbox-sidebar">
                <a href="<?php echo SURL; ?>support/newticket" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
                    <i class="fa fa-pencil"></i><span><?php echo Filtration\Core\System::translate("Open Ticket"); ?></span> </a>
                <ul class="list-unstyled mailbox-list">
                    <li class="active"> <a href="<?php echo SURL; ?>support/"><?php echo Filtration\Core\System::translate("All Tickets"); ?>
                            <span class="pull-right"><?php echo $all; ?></span> </a> </li>
                    <li> <a href="<?php echo SURL; ?>support/?type=open"><?php echo Filtration\Core\System::translate("Open Tickets"); ?></a> </li>
                    <li> <a href="<?php echo SURL; ?>support/?type=closed"><?php echo Filtration\Core\System::translate("Closed Tickets"); ?></a> </li>
                </ul>
                <div class="vspacer"></div>
            </div>
        </div>
        <div class="col-sm-9 mailbox-right panel">
            <div class="modal-body">
                <div class="form-group">
                    <form role="form" method="post">
                        <input type="hidden" name="check_submit" value="1">
                        <label for="title"><?php echo Filtration\Core\System::translate("Title"); ?>:</label>
                        <input class="form-control" name="title" type="text" id="title">
                        </div>
                        <div class="form-group">
                            <label for="client"><?php echo Filtration\Core\System::translate("Category"); ?>:</label>
                            <select name="category" class="form-control">
                                <option value="account"><?php echo Filtration\Core\System::translate("Account"); ?></option>
                                <option value="general"><?php echo Filtration\Core\System::translate("General Enquiries"); ?></option>
                                <option value="technical"><?php echo Filtration\Core\System::translate("Technical Department"); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status"><?php echo Filtration\Core\System::translate("Status"); ?>:</label>
                            <select name="status" class="form-control">
                                <option value="basic"><?php echo Filtration\Core\System::translate("Basic"); ?></option>
                                <option value="medium"><?php echo Filtration\Core\System::translate("Medium"); ?></option>
                                <option value="urgent"><?php echo Filtration\Core\System::translate("Urgent"); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control wysihtml5" name="message"></textarea>
                        </div>
                        <div class="modal-footer clearfix">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i>Discard
                            </button>
                            <button type="submit" class="btn btn-primary pull-left" style="background-color: #428bca;">
                                <i class="fa fa-envelope"></i>Submit Ticket
                            </button>
                    </form>
                </div>
                <br />