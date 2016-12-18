<div class="panel panel-default ">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Open Buying Orders"); ?></h3>
    </div>

    <div class="panel-body">
        <div>
            <table class="table">
                <thead>
                    <tr role="row">
                        <th><?php echo Filtration\Core\System::translate("Market"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Amount"); ?>
                        <th><?php echo Filtration\Core\System::translate("Cost"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Time"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Actions"); ?></th>
                </tr>
                </thead>
                <tbody class="middle-align">
                    <?php foreach ($buyorders as $r) { ?>     
                        <tr>
                            <td><?php echo System::escape($r->market); ?></td>
                            <td><?php echo System::escape($r->amount); ?></td>
                            <td><?php echo System::escape($r->cost); ?></td>
                            <td><?php echo System::escape($r->price); ?></td>
                            <td><?php echo System::escape($r->time); ?></td>
                            <td>
                                <a id="<?php echo System::escape($r->id); ?>" class=" deleteorderbbtn btn-danger btn-sm btn-icon icon-left">
                                    <?php echo Filtration\Core\System::translate("Cancel"); ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Open Selling Orders"); ?></h3>
    </div>

    <div class="panel-body">
        <div>
            <table class="table">
                <thead>
                    <tr role="row">
                        <th><?php echo Filtration\Core\System::translate("Market"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Amount"); ?>
                        <th><?php echo Filtration\Core\System::translate("Cost"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Time"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Actions"); ?></th>
                    </tr>
                </thead>
                <tbody class="middle-align">
                    <?php
                    foreach ($sellorders as $r) {
                        ?>
                        <tr>
                            <td><?php echo $r->market; ?></td>
                            <td><?php echo $r->amount; ?></td>
                            <td><?php echo $r->cost; ?></td>
                            <td><?php echo $r->price; ?></td>
                            <td><?php echo $r->time; ?></td>
                            <td>
                                <a id="<?php echo System::escape($r->id); ?>" class="deleteorders btn btn-danger btn-sm btn-icon icon-left">
                                    <?php echo Filtration\Core\System::translate("Cancel"); ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($)
    {
        $("#deleteorderb").click(function ()
        {
            $("#deleteorder").attr('href', '<?php echo SURL; ?>dashboard/delete_orders/?id=' + $(this).attr('id') + '/buy');
        });
        $("#deleteorders").click(function ()
        {
            $("#deleteordersl").attr('href', '<?php echo SURL; ?>dashboard/delete_orders/' +  $(this).attr('id') + '/sell');
        });
    });
</script>