<div class="panel panel-default">
    <div class="panel-heading hidden-print"><?php echo Filtration\Core\System::translate("Invoice"); ?></div>
    <div class="panel-body">

        <section class="invoice-env">
            <!-- Invoice header -->
            <div class="invoice-header">
                <!-- Invoice Options Buttons -->
                <div class="invoice-options hidden-print">
                    <a href="#" class="btn btn-block btn-gray btn-icon btn-icon-standalone btn-icon-standalone-right text-left">
                        <i class="fa-envelope-o"></i>
                        <span><?php echo Filtration\Core\System::translate("Send"); ?></span>
                    </a>

                    <a href="#" onclick="window.print();" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right btn-single text-left">
                        <i class="fa-print"></i>
                        <span><?php echo Filtration\Core\System::translate("Print"); ?></span>
                    </a>
                </div>

                <!-- Invoice Data Header -->
                <div class="invoice-logo">

                    <a href="#" class="logo">
                        <img src="<?php echo SITE_URL; ?>img/logo.png" class="img-responsive">
                    </a>

                    <ul class="list-unstyled">
                        <li class="upper"><?php echo Filtration\Core\System::translate("Invoice No"); ?>. <strong>#<?php echo System::escape($this->invoice->trade_id); ?></strong></li>
                        <li><?php echo System::escape($this->invoice->trade_date); ?></li>
                    </ul>

                </div>

            </div>


            <!-- Client and Payment Details -->
            <div class="invoice-details">

                <div class="invoice-client-info">
                    <strong><?php echo Filtration\Core\System::translate("Client"); ?></strong>

                    <ul class="list-unstyled">
                        <li><?php echo System::escape($this->user->user_firstname); ?> </li>
                        <li><?php echo System::escape($this->user->user_lastname); ?> </li>
                    </ul>

                    <ul class="list-unstyled">
                        <li><?php echo System::escape($this->user->user_address1); ?> </li>
                        <li><?php echo System::escape($this->user->user_address2); ?> </li>
                        <li><?php echo System::escape($this->user->user_city); ?> </li>
                        <li><?php echo System::escape($this->user->user_zip); ?> </li>
                    </ul>
                </div>

                <div class="invoice-payment-info">
                    <strong><?php echo Filtration\Core\System::translate("Company Details"); ?>:</strong>

                    <ul class="list-unstyled">
                        <li><?php echo Filtration\Core\System::translate("Company Reg"); ?>: #<strong><?php echo COMPANY_REGISTRATION_NUMBER; ?></strong></li>
                        <li><?php echo Filtration\Core\System::translate("Website Name"); ?>: <strong><?php echo SITE_NAME; ?></strong> </li>
                        <li><?php echo Filtration\Core\System::translate("Address"); ?>: </li>
                        <li>
							<strong>
								<?php echo MAIN_ADDRESS_NAME; ?><br>
								<?php echo MAIN_ADDRESS_STREET; ?><br>
								<?php echo MAIN_ADDRESS_TOWN; ?><br>
								<?php echo MAIN_ADDRESS_COUNTY; ?><br>
								<?php echo MAIN_ADDRESS_POSTCODE; ?><br>
								<?php echo MAIN_ADDRESS_COUNTRY; ?><br>
							</strong>
						</li>
                    </ul>
                </div>

            </div>

            <!-- Invoice Entries -->
            <table class="table table-bordered">
                <thead>
                    <tr class="no-borders">
                        <th class="text-center hidden-xs"><?php echo Filtration\Core\System::translate("Market"); ?></th>
                        <th class="text-center hidden-xs"><?php echo Filtration\Core\System::translate("Quantity"); ?></th>
                        <th class="text-center"><?php echo Filtration\Core\System::translate("Price"); ?></th>
                        <th class="text-center"><?php echo Filtration\Core\System::translate("Date"); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="text-center hidden-xs"><?php echo System::escape($this->invoice->trade_market); ?></td>
                        <td><?php echo System::escape($this->invoice->trade_amount); ?></td>
                        <td class="text-center hidden-xs"><?php echo System::escape($this->invoice->trade_cost); ?></td>
                        <td class="text-right text-primary text-bold"><?php echo System::escape($this->invoice->trade_date); ?></td>
                    </tr>

                </tbody>
            </table>

            <!-- Invoice Subtotals and Totals -->
            <div class="invoice-totals">
                <div class="invoice-subtotals-totals">
                    <span>
                        <?php echo Filtration\Core\System::translate("Total amount (before fee)"); ?>:
                        <strong></strong>
                    </span>
                    <span>
                        <?php echo Filtration\Core\System::translate("Fee Percentage"); ?>:
                        <strong><?php echo TRANSACTION_FEES; ?>%</strong>
                    </span>
                    <hr>
                    <span>
                        <?php echo Filtration\Core\System::translate("Grand Total (after fee) "); ?>:
                        <strong><?php echo System::escape($this->invoice->trade_cost); ?></strong>
                    </span>
                </div>
            </div>
        </section>
    </div>
</div>
