<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;

Class VerificationModel
{
	public function isbanned($user, $site) 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
        $checkbanlist = $this->db->prepare("SELECT * FROM banlist WHERE username=?");
        $checkbanlist->execute(array($user->username));
        $banneduser = $checkbanlist->fetch();
        if ($banneduser) {
            echo '
				  <div class="row row-centered">
				  <div class="col-md-3"></div>
                  <div class="col-md-5">
			      <div class="alert alert-danger">
			      <strong>';
            echo Filtration\Core\System::translate("Oh snap!");
            echo '</strong> ';
            echo Filtration\Core\System::translate("You are banned.");
            echo '<b><u> ';
            echo Filtration\Core\System::translate("Do not");
            echo '</u></b> ';
            echo Filtration\Core\System::translate("register another account");
            echo '<br>';
            echo Filtration\Core\System::translate("Reason you are banned:");
            echo '<b><u>' . $banneduser->reason . '</u></b>
				  </div>
				  </div>
				  </div>';

            require APP . 'views/_templates/footer.php';
            die;
        }
    }

    public function isemailverified($user, $site) 
	{
		//if we require email verification
        if (REQUIRE_EMAIL_VERIFY == 'verify') 
		{
			//they've not verified their email yet
            if ($user->user_emailverified == 'unverified') {
                echo'
				  <div class="row row-centered"><div class="col-md-3"></div><div class="col-md-5">
			      <div class="alert alert-danger"><strong>'. Filtration\Core\System::translate("Oh snap!"). '</strong>'.
				  Filtration\Core\System::translate("Please verify your email").'</div></div></div>';
                require APP . 'views/_templates/footer.php';
                die;
            }
        }
    }

    public function twofacverify($user) 
	{
		//let them know they haven't enabled two factor auth
        if ($user->user_twofactor == 0) {
            echo '
				<div class="row row-centered"><div class="col-md-4 col-md-offset-4">
			    <div class="alert alert-info"><strong>'. Filtration\Core\System::translate("Secure account. Enable Two factor Authentication").'
				<a href="' . SURL . 'user/twofactor">'.Filtration\Core\System::translate("Here"). '</a></strong></div></div></div>';
        }
    }

    public static function is_verified($user, $site) 
	{
		//if we require ID verification
        if (USER_VERIFY_ID == 'enabled') 
		{
			//they've not submited a file and we've not verified
            if ($user->user_detailverified == 'unverified' && $user->user_detailssubmitted == 'notsubmitted') 
			{
                require Config::get('PATH_VIEWS') . 'views/user/verify.php';
                require Config::get('PATH_VIEWS') . 'views/_templates/footer.php';
                exit();
           
			////they've submited their ID but we've not verified yet
			}else if ($user->user_detailssubmitted == 'submited' && $user->detailverified == 'unverified') 
			{
				//leave them a message
				exit('<div class="col-md-6 col-xs-offset-3"><div class="alert alert-success"><strong>'. Filtration\Core\System::translate("Details Submitted!").'
					</strong>'. Filtration\Core\System::translate("Please wait for our team to verify your details").'</div></div>');
            }
        }
    }
	
	public static function upload_id()
	{

		// Variable for indexing uploaded image.
        $j = 0; 
        
		//if folder doesn't exist create it
		if (!file_exists(SURL_PUB . "/userverify/" . Session::get('user_id') . "/")) {
            mkdir(SURL_PUB . "/userverify/" . Session::get('user_id'). "/", 0777);
        }
       
	    // Declaring Path for uploaded images.
	    $target_path = SURL_PUB . "/userverify/" . Session::get('user_id') . "/"; 
        
		for ($i = 0; $i < count($_FILES['file']['name']); $i++)
		{
            // Extensions which are allowed.
            $validextensions = array(
                "jpeg",
                "jpg",
                "png"); 
                
				// Explode file name from dot(.)
				$ext = explode('.', basename($_FILES['file']['name'][$i]));
                
				// Store extensions in the variable.
				$file_extension = end($ext); 
                
				// Set the target path with a new name of image.
				$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1]; 
                
				// Increment the number of uploaded images according to the files in array.
				$j = $j + 1; 
                
				//if it's below max file size and a valid image carry on
				if (($_FILES["file"]["size"][$i] < MAX_FILE_SIZE) && in_array($file_extension, $validextensions)) 
				{
                    if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
                        
						//get the users info
						$user = UserModel::user();
                        
						//all their images
						$allimgs = $verimgs->user_verifyimg . "," . $target_path;
                        
						//run the sql
						$insert = $database->prepare("UPDATE user SET user_verifyimg = ? WHERE user_id = ?");
						$insert->execute(array($allimgs, Session::get('user_id')));
                        
						//update their information
						$this->model->userverifydetails(Request::post('firstname'), Request::post('lastname'), Request::post('address1'), 
														Request::post('address2'), Request::post('city'), Request::post('zip'),
														Request::post('state'), Request::post('country'), Request::post('dob'),
														Session::get('user_id'));
                        
                        NotificationsModel::addmessage("You have submitted verification details", "You have recently submitted information for our user 
													verification. Our team will verify this <b><u>as soon as possible</u></b>", Session::get('user_id'), "System", "account");
                        
						//success message here
                        
                    } else { 
                        echo $j . ').<span id="error">please try again!.</span><br/><br/>';
                    }
                } else { 
                    echo $j . ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
                }
            }
        }
		
	}
	
    public static function userverifydetails($firstname, $lastname, $address1, $address2, $city, $zip, $state, $country, $dob, $username) 
	{
        
		//get the user's info
        $user = UserModel::user();
		
        if ($user>user_detailssubmitted == 'submitted') 
		{    
	
			//sql to run
			$sql = "UPDATE user 
					SET	user_firstname = ?,
						user_lastname = ?,
						user_address1 = ?, 
						user_address2 = ?,
						user_city = ?,
						user_zip = ?,
						user_state = ?,
						user_country = ?,
						user_dob = ?, 
						user_detailssubmitted = 'submitted' 
						WHERE user_id = ?";
						
			//run the sql
			$updateuser = $this->db->prepare($sql);
            $updateuser->execute(array($firstname, $lastname, $address1, $address2, $city, 
									   $zip, $state, $country, $dob, $username->username));
        }
    }
}