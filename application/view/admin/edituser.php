<div class="col-sm-9 col-xs-12">
    <div class="panel">
        <div class="panel-body">
            <div class="member-form-add-header">
                <div class="row">
                    <div class="col-md-10 col-sm-8">
                        <div class="user-name"> <a href="#"><?php echo System::escape($this->edituser->user_firstname); ?> <?php echo System::escape($this->edituser->user_lastname); ?></a> </div>
                    </div>
                </div>
            </div>
            <div class="member-form-inputs">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label" for="username">User id</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo System::escape($this->edituser->user_id); ?>" disabled=""> </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label" for="name">Full Name</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" disabled id="name" value="<?php echo System::escape($this->edituser->user_firstname); ?> <?php echo System::escape($this->edituser->user_lastname); ?>"> </div>
                </div>	  
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label" for="birthdate">Birthdate</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" disabled class="form-control datepicker" name="birthdate" data-format="dd-mm-yyyy" value="<?php echo System::escape($this->edituser->user_dob); ?>">
                            <div class="input-group-addon"> <a href="#"><i class="linecons-calendar"></i></a> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label" for="birthdate">Address</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php echo System::escape($this->edituser->user_address1); ?>" disabled>
                        <br/>
                        <input type="text" class="form-control" value="<?php echo System::escape($this->edituser->user_address2); ?>" disabled>
                        <br/>
                        <input type="text" class="form-control" value="<?php echo System::escape($this->edituser->user_zip); ?>" disabled>
                        <br/>
                        <input type="text" class="form-control" value="<?php echo System::escape($this->edituser->user_state); ?>" disabled>
                        <br/>
                        <input type="text" class="form-control" value="<?php echo System::escape($this->edituser->user_country); ?>" disabled>
                    </div>
                </div>	

                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label" for="birthdate">Other Information</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php
                        if ($this->edituser->user_emailverified == 1): echo 'Email is verified';
                        else: echo 'Email is not verified';
                        endif;
                        ?>" disabled>
                        <br />
                        <input type="text" class="form-control" value="<?php
                        if ($this->edituser->user_detailssubmitted == 1): echo 'Details have been submitted';
                        else: echo 'Details have not been submitted';
                        endif;
                        ?>" disabled>
                        <br />
                        <input type="text" class="form-control" value="<?php
                        if ($this->edituser->user_twofactor == 1): echo 'Twofactor is enabled';
                        else: echo 'Twofactor is not enabled';
                        endif;
                        ?>" disabled>
                        <br />
                        <input type="text" class="form-control" value="<?php
                        if ($this->edituser->user_banned == 1): echo 'User is banned';
                        else: echo 'User is not banned';
                        endif;
                        ?>" disabled>
                        <br />		    
                        <input type="text" class="form-control" value="<?php
                        if (!empty($this->edituser->user_ipwhitelist)): echo 'User has a IP whitelist set';
                        else: echo 'User does not have an IP whitelist set';
                        endif;
                        ?>" disabled>
                        <br />	
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Security Questions</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" disabled value="<?php echo System::escape($this->edituser->user_security_question1); ?>">
                        <br/>
                        <input type="text" class="form-control" disabled value="<?php echo System::escape($this->edituser->user_security_answer1); ?>">
                        <br/>
                        <input type="text" class="form-control" disabled value="<?php echo System::escape($this->edituser->user_security_question2); ?>">
                        <br/>
                        <input type="text" class="form-control" disabled value="<?php echo System::escape($this->edituser->user_security_answer2); ?>">   
                    </div>

                </div>
                <?php if (UserModel::user_role('admin') == true): ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="control-label">Verification Images</label>
                        </div>
                        <div class="col-sm-9">
                            <?php
                            $idimages = 0;
                            $imghref = explode(",", $this->edituser->user_verifyimg);
                            foreach ($imghref as $img => $key) {
                                $imghref > 0;
                                echo'<img class="col-xs-12 col-sm-6" src="' . ADMIN_SITE_URL . "/getuserimg?img=" . $key . '&user=' . $this->edituser->user_id . '">&nbsp;';
                            } if ($this->edituser->user_detailverified == 0 && $this->edituser->user_invalidid == 0) {
                                ?>
                                <br/><br/>
                                <a href="<?php echo ADMIN_SITE_URL . '/invalidid/' . $this->edituser->user_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                                    Invalid ID
                                </a>
                                <a href="<?php echo ADMIN_SITE_URL . '/validid/' . $this->edituser->user_id; ?>" class="btn btn-success btn-sm btn-icon icon-left">
                                    Valid ID
                                </a>
                            </div>
                        </div>
                    <?php } endif;
                ?>
            </div>
        </div>
    </div></div>