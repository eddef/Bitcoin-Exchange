<?php 
use Filtration\Core\System;
?>

<script src="<?php echo SURL; ?>js/bootstrap.min.js"></script>
<script src="<?php echo SURL; ?>js/application.js"></script>
<script src="<?php echo SURL; ?>js/TweenMax.min.js"></script>
<script src="<?php echo SURL; ?>js/resizeable.js"></script>
<script src="<?php echo SURL; ?>js/joinable.js"></script>
<script src="<?php echo SURL; ?>js/xenon-api.js"></script>
<script src="<?php echo SURL; ?>js/xenon-toggles.js"></script>
<script src="<?php echo SURL; ?>js/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo SURL; ?>js/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo SURL; ?>js/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo SURL; ?>js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
<script src="<?php echo SURL; ?>js/datatables/tabletools/dataTables.tableTools.min.js"></script>
<script src="<?php echo SURL; ?>js/xenon-custom.js"></script>
<script src="<?php echo SURL; ?>js/jquery-validate/jquery.validate.min.js"></script>
<script src="<?php echo SURL; ?>js/amcharts.js" type="text/javascript"></script>
<script src="<?php echo SURL; ?>js/serial.js" type="text/javascript"></script>
<script src="<?php echo SURL; ?>js/amstock.js" type="text/javascript"></script>
<script src="<?php echo SURL; ?>js/notify.js" type="text/javascript"></script>

<footer class="footer hidden-xs">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="footer-col links col-md-2 col-sm-4 col-xs-6">
                    <div class="footer-col-inner">
                        <h3 class="title"><?php echo Filtration\Core\System::translate("About Us"); ?></h3>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo SURL; ?>pages/page/jobs"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("Jobs"); ?></a></li>
                            <li><a href="<?php echo SURL; ?>home/order_book"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("Order Book"); ?></a></li>
                            <li><a href="<?php echo SURL; ?>help/faq'; ?>"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("F.A.Q"); ?></a></li>
                        </ul>
                    </div>
                    <!--//footer-col-inner-->
                </div>
                <!--//foooter-col--> 
                <div class="footer-col links col-md-2 col-sm-4 col-xs-6">
                    <div class="footer-col-inner">
                        <h3 class="title"><?php echo Filtration\Core\System::translate("Product"); ?></h3>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo SURL; ?>help/guide"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("How it works"); ?></a></li>
                            <li><a href="<?php echo SURL; ?>/api/"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("API"); ?></a></li>
                            <li><a href="<?php echo SURL; ?>pages/page/fees'; ?>"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("Fees"); ?></a></li>
                        </ul>
                    </div>
                    <!--//footer-col-inner-->
                </div>
                <!--//foooter-col--> 
                <div class="footer-col links col-md-2 col-sm-4 col-xs-6">
                    <div class="footer-col-inner">
                        <h3 class="title"><?php echo Filtration\Core\System::translate("Support"); ?></h3>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo SURL; ?>support"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("Ticket Centre"); ?></a></li>
                            <li><a href="<?php echo SURL; ?>help/"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("Help"); ?></a></li>
                            <li><a href="<?php echo SURL; ?>pages/page/tos'; ?>"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("Terms of services"); ?></a></li>
                            <li><a href="<?php echo SURL; ?>pages/page/privacy'; ?>"><i class="fa fa-caret-right"></i><?php echo Filtration\Core\System::translate("Privacy"); ?></a></li>
                        </ul>
                    </div>
                    <!--//footer-col-inner--> 
                </div>
                <!--//foooter-col--> 
                <div class="footer-col links col-md-2 col-sm-4 col-xs-6">
                    <div class="footer-col-inner">
                        <h3 class="title"><?php echo Filtration\Core\System::translate("Contact us"); ?></h3>
                        <p class="adr clearfix"> 
                            <span class="adr-group pull-left"> 
                                <span class="street-address">
									<?php echo MAIN_ADDRESS_NAME; ?><br/>
									<?php echo MAIN_ADDRESS_STREET; ?><br/>
									<?php echo MAIN_ADDRESS_TOWN; ?><br/>
									<?php echo MAIN_ADDRESS_COUNTY; ?><br/>
									<?php echo MAIN_ADDRESS_POSTCODE; ?><br/>
								</span><br>

                            </span>
                        </p>
                        <p class="tel"><?php echo CONTACT_PHONE; ?> &nbsp;<i class="fa fa-phone"></i></p>
                        <p class="email"><a href="#"><?php echo CONTACT_EMAIL; ?> </a> &nbsp;<i class="fa fa-envelope-o"></i></p>
                    </div>
                    <!--//footer-col-inner-->
                </div>
                <div class="footer-col connect col-md-3 col-sm-12 col-xs-6">
                    <div class="footer-col-inner">
                        <ul class="social list-inline">
                            <li><a href="http://twitter.com/<?php echo TWITTER_USER; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.facebook.com/<?php echo FACEBOOK_PAGE; ?>"><i class="fa fa-facebook"></i></a></li>
                            <p>
                            <div>
                                <a href="<?php echo SURL; ?>/home/language?id=en_GB" style="padding-right: 5px;"><img src="<?php echo SURL; ?>/img/uk.png" alt="en"></a>
                                <a href="<?php echo SURL; ?>/home/language?id=zh_CN" style="padding-right: 5px;"><img src="<?php echo SURL; ?>/img/china.png" alt="cn"></a>
                                <a href="<?php echo SURL; ?>/home/language?id=ru_RU" style="padding-right: 5px;"><img src="<?php echo SURL; ?>/img/ru.png" alt="ru"></a>
                                <a href="<?php echo SURL; ?>/home/language?id=es_ES" style="padding-right: 5px;"><img src="<?php echo SURL; ?>/img/espanol.png" alt="es"></a>

                            </div> 
                            </p>
                        </ul>
                    </div>
                    <!--//footer-col-inner-->
                </div>
                <!--//foooter-col-->
                <div class="clearfix"></div>
            </div>
            <!--//row-->
        </div>
        <!--//container-->
    </div>
    <!--//footer-content-->
</footer>
</div>
