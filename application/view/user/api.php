<div class="col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Generate API"); ?></h3>
        </div>
        <div class="panel-body">
            
            <div class="alert alert-success" id="success_message" style="display: none"></div>
            <div class="alert alert-warning" id="error_message" style="display: none"></div>
            
            <div style="margin-bottom: 15px;">
                <form action="<?php echo SURL; ?>api/generateapi" method="POST" id="generateapi">

                    <div class="input-group m-t-10">
                        <input type="name" name="name" placeholder="<?php echo Filtration\Core\System::translate("Enter Name"); ?>" class="form-control" placeholder="API Name">
                        <span class="input-group-btn">
                            <input type="submit" value="<?php echo Filtration\Core\System::translate("Generate API"); ?>" class="btn waves-effect waves-light btn-primary">
                        </span>
                    </div>
                </form>
            </div>
                
            <?php if(!empty($this->apis)): ?>
                <table class="table">
                    <thead>
                        <tr role="row">
							<th><?php echo Filtration\Core\System::translate("Name"); ?></th>
							<th><?php echo Filtration\Core\System::translate("Key"); ?></th>
							<th><?php echo Filtration\Core\System::translate("Secret"); ?></th>
							<th><?php echo Filtration\Core\System::translate("Actions"); ?></th>
                    </tr>
                    </thead>
                    <tbody class="middle-align">
                        <?php foreach ($this->apis as $uapi) { ?>
                            <tr role="row" class="odd" id="api-<?php echo Filtration\Core\System::escape($uapi->api_id); ?>">
                                <td><?php echo Filtration\Core\System::escape($uapi->api_name); ?></td>
                                <td><?php echo Filtration\Core\System::escape($uapi->api_pubkey); ?></td>
                                <td><?php echo Filtration\Core\System::escape($uapi->api_secret); ?></td>
                                <td>
                                    <a href="<?php echo SURL; ?>api/deleteapi/<?php echo Filtration\Core\System::escape($uapi->api_id); ?>" id="<?php echo Filtration\Core\System::escape($uapi->api_id); ?>" class="btn btn-danger btn-sm btn-icon deleteapi icon-left">
                                        <?php echo Filtration\Core\System::translate("Delete"); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    <?php echo Filtration\Core\System::translate("You currently have no API keys generated."); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
