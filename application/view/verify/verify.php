<script src="<?php echo SITE_URL; ?>js/imgverify.js"></script>
<style>
    #noerror {
        color: green;
        text-align: left
    }
    #error {
        color: red;
        text-align: left
    }
    #img {
        width: 17px;
        border: none;
        height: 17px;
        margin-left: -20px;
        margin-bottom: 91px
    }
    .abcd {
        text-align: center
    }
    .abcd img {
        height: 100px;
        width: 100px;
        padding: 5px;
        border: 1px solid #e8debd
    }
</style>
<div class="container">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo Filtration\Core\System::translate("User Verification form"); ?>
        </h3>
    </div>

    <div class="panel panel-default panel-body col-xs-12 col-md-12 col-lg-7">

        <div class="row">

            <div class="alert alert-info" style="margin:10px">
                <button class="close" data-dismiss="alert" type="button"><span>×</span> <span class="sr-only">Close</span>
                </button>
                <?php echo Filtration\Core\System::translate("Upload a valid form of identification. Driving licenses, passports, Government Issued ID's"); ?>
            </div>
			
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="<?php echo SITE_URL; ?>user/veridetails" class="validate" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        <div class="row col-margin">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" data-message-required="Please enter your First Name" data-validate="required" name="firstname" placeholder="<?php echo Filtration\Core\System::translate("First Name"); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" data-message-required="Please enter your Last Name" data-validate="required" name="lastname" placeholder="<?php echo Filtration\Core\System::translate("Last Name"); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" data-validate="required" id="address" name="address" placeholder="<?php echo Filtration\Core\System::translate("Address line 1"); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" data-validate="required" id="address" name="address2" placeholder="<?php echo Filtration\Core\System::translate("Address line 2"); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" data-validate="required" id="address" name="city" placeholder="<?php echo Filtration\Core\System::translate("City"); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" data-validate="required" id="address" name="zipcode" placeholder="<?php echo Filtration\Core\System::translate("Postal Code"); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" data-validate="required" id="address" name="state" placeholder="<?php echo Filtration\Core\System::translate("State/Provinince"); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" data-validate="required" name="country" id="sboxit-2">
                                        <option>Select your country</option>
                                        <option value="Afghanistan">Afghanistan</option> 
                                        <option value="Åland Islands">Åland Islands</option> 
                                        <option value="Albania">Albania</option> 
                                        <option value="Algeria">Algeria</option> 
                                    </select>
                                </div>	
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <input type="text" data-validate="required" placeholder="<?php echo Filtration\Core\System::translate("Date of birth"); ?>" class="form-control datepicker" data-format="D, dd MM yyyy">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="panel-body">
                    <div id="filediv">
                        <input name="file[]" type="file" id="file" />
                    </div>
                    <br/><input type="button" id="add_more" class="upload btn btn-info" value="Add More Files" />
                    <input type="submit" value="Validate Information"  class="btn btn-success"  data-message-required="Please select your identification" data-validate="required" name="submit" id="upload" class="upload" />
                    </form>
                </div>
            </div>
        </div>
    </div>

<div class="col-sm-12 col-md-12 col-lg-5"> 
    <div class="well  ">
        <p class="lead"><?php echo Filtration\Core\System::translate("How to verify"); ?></p>
        <ul class="media-list">
            <li class="media">
                <a href="#" class="btn btn-default btn-circle btn-lg pull-left" style="margin:0 10px 0 0; font-size:20px;" disabled="">1</a>
                <div class="media-body">
                    <p class="lead" style="margin-top:10px"><?php echo Filtration\Core\System::translate("Fill out our form"); ?></p>
                    <p>
                        <?php echo Filtration\Core\System::translate("All inputs must be filled out. All information must be correct. Once you have submitted your verification information a member of our team will verify the details and either accept or decline. If your verification is declined a member of our team will contact you with the next steps"); ?>
                    </p>
                </div>
            </li>
            <li class="media">
                <a href="#" class="btn btn-default btn-circle btn-lg pull-left" style="margin:0 10px 0 0; font-size:20px;" disabled="">2</a>

                <div class="media-body">
                    <p class="lead" style="margin-top:10px"><?php echo Filtration\Core\System::translate("2 Documents must be supplied"); ?></p>
                    <p>

                        <?php echo Filtration\Core\System::translate("A valid passport or national ID"); ?></p>
                    <p>
                        <?php echo Filtration\Core\System::translate("Please supply a recent (no older than 3 months old) bank statement, utility bill or valid proof of address document. The information must be clear (we recommend a scanned document.)"); ?>
                    </p>
                    <p>
                    <h5><?php echo Filtration\Core\System::translate("Document Requirements"); ?></h5>
                    <ul>
                        <li><?php echo Filtration\Core\System::translate("No larger than 10MB"); ?></li>
                        <li><?php echo Filtration\Core\System::translate("JPEG,PNG,JPG,PDF"); ?></li>
                        <li><?php echo Filtration\Core\System::translate("Must be scanned, no screenshots or phone pictures"); ?></li>
                    </ul>
                    </p>

                </div>
            </li>
            <li class="media">
                <a href="#" class="btn btn-default btn-circle btn-lg pull-left" style="margin:0 10px 0 0; font-size:20px;" disabled="">3</a>

                <div class="media-body">
                    <p class="lead" style="margin-top:10px"><?php echo Filtration\Core\System::translate("Click the 'validate information' button"); ?></p>
                </div>
            </li>
        </ul>
    </div>
</div>
