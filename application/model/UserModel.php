<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
use Filtration\Core\Session;
use Filtration\Core\Request;
use Filtration\Core\Alert;
use Filtration\Core\Redirect;

Class UserModel
{
	public static function logged_in()
    {
        // check if they're logged in
		return (Session::get('user_id') ? true : false);
    }

    public static function logout()
    {
    	// destroy the session
        Session::destroy();

        //PUT THAT COOKIE DOWN, NOW! (Arnie reference)
        if (isset($_COOKIE['XE_RememberMe'])) {
            unset($_COOKIE['XE_RememberMe']);
            setcookie('XE_RememberMe', null, -1, '/');
        }

    }
	
	public static function authentication() 
	{
        // initialize the session (if not initialized yet)
        Session::init();

        // if user is not logged in...
        if (!UserModel::logged_in()) {
            //  ... then treat user as "not logged in", destroy session, redirect to login page
            Session::destroy();
            Redirect::to('home/indexa');
            exit();
        }
    }
	
	public static function user() 
	{
		
		// iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();		
		
		// sql to run
		$sql = "SELECT * FROM users 
				WHERE user_id = ?";
		
		// run the sql
        $user = $database->prepare($sql);
        $user->execute(array(Session::get('user_id')));
        
		// return the results
		return $user->fetch();
    }
	
    public static function user_role($role) 
	{
		
        if (UserModel::user()->user_role == $role):
            return true;
        endif;
    }
	
 //    public static function isstaff() 
	// {
		
	// 	// iniate the database
	// 	$database = DatabaseFactory::getFactory()->getConnection();		
		
	// 	// sql to run
	// 	$sql = "SELECT user_role FROM users 
	// 			WHERE user_id = ?";
		
		
	// 	// run the sql
 //        $admin = $database->prepare($sql);
 //        $admin->execute(array(Session::get('user_id')));
	// 	$checkadmin = $admin->fetch();
		
 //        if ($checkadmin->user_role == 'admin'):
 //            return true;
 //        endif;
 //    }
	
	public static function log_login($email, $type = null)
	{
		// iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();	

		// sql to run
		$sql = "INSERT INTO logins
				(
					login_email,
					login_ip,
					login_status
				) 
				VALUES
				(
					?,
					?,
					?
				)";
		
		// failed of successful
		$loginType = ($type == 'success') ? 'Successful login' : 'Unsuccessful login';

		// run the sql
		$addlogin = $database->prepare($sql);
        $addlogin->execute(array($email, $_SERVER["REMOTE_ADDR"], $loginType));
	}
	
	public static function brute_force()
	{
		// iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();	

		$date = date("y-m-d h:i:s");
        $dateto = date("y-m-d h:i:s", strtotime("-15 minutes"));
                
		// sql to run
		$sql = "SELECT count(*) as attempts FROM logins 
			   	WHERE login_ip = ? 
			   		AND login_status = 'Unsuccessful login' 
			   		AND login_date BETWEEN ? AND ? 
			   	ORDER BY login_date DESC";
		
		// run the sql
		$checkbrute = $database->prepare($sql);
        $checkbrute->execute(array($_SERVER["REMOTE_ADDR"], $dateto, $date));
        
		// get the results
		$checkbrutetimes = $checkbrute->fetch();

		if($checkbrutetimes->attempts > 5):
			Alert::error('login_disabled_brute_force', true);
		endif;
	}
	
	public static function login()
    {
        // start the session
		Session::init();
		
        // check to make sure there's a user with that email
        $check_email = UserModel::Check_Details('email', Request::post('mail')); 
       
        if($check_email == true)
        {
            // that's good the user exists. 
            $database = DatabaseFactory::getFactory()->getConnection();
			
			// sql ro run
			$login_sql = "SELECT *
						  FROM users 
						  WHERE user_email = ? ";
						  
			// run the query
            $database_user = $database->prepare($login_sql);
            $database_user->execute(array(Request::post('mail')));
            $user_information = $database_user->fetch();
            
			// if their accounts enabled or not
			if($user_information->user_enabled != 'enabled' && $user_information->user_banned == 'banned'):
				exit(json_encode(array("success" => false, "error" => $user_information->user_ban_info)));
			elseif($user_information->user_enabled != 'enabled'):
			endif;
			
			// brute force attack
			UserModel::brute_force();
			
			// check if they have ip whitelist set
			$whitelistip = $user_information->user_ipwhitelist;
			if (!empty($user_information->ipwhitelist) && in_array($_SERVER["REMOTE_ADDR"], $whitelistip, false)):
				Alert::error('ip_not_match', true);
			endif;
						
			// check the results
            if($database_user->rowCount())
            {   
				// check to make sure passwords match
                if(password_verify(Request::post('pass'), $user_information->user_password))
                {
				
                    // success create sessions
                    Session::set('logged_in', 'true');
                    Session::set('user_id', $user_information->user_id);
					Session::set('email', Request::post('mail'));
					// UserModel::newtoken();
                    
					// notify them of their login
					if ($user_information->user_loginnotify == 'enabled'):
                        // if they have a login notification
                        Mail::sendemail($user_information->user_email, 'Login notification', '
							You have just logged in with an IP address of: ' . $_SERVER['SERVER_ADDR'] . '. If this is not you, 
							please contact support as soon as possible', SITE_NAME);
                    endif;
					
                    // make sure the session has been set in the odd chance it's not
                    if(Session::get('user_id') == true):
                    	SELF::log_login(Request::post('mail'), 'success');
                        Alert::success('success_logging_in', true); // success message
                    else:
                        Alert::error("unknown_error", true);
                    endif;
                }
                else
                {
					// UserModel::bruteforce('set');
				 	SELF::log_login(Request::post('mail'), 'failed'); // brute force
                    Alert::error('wrong_email_or_password', true); // cannot login error
                    return false; // for our controller
                }
            }
            else
            {
				// UserModel::bruteforce('set'); // set our brute force
                Alert::error('wrong_email_or_password', true); // user does not exist error
				SELF::log_login(Request::post('mail'), 'failed'); // brute force
                return false; // for our controller
            }
       }
       else{
			// UserModel::bruteforce('set');
			Alert::error('wrong_email_or_password', true); // user does not exist error
			SELF::log_login(Request::post('mail'), 'failed'); // brute force
	  	}

    }
	
 	public static function register()
    {
		// check if passwords match
		if(Request::post('password') != Request::post('password2')): 				
			// return the error
			exit(Alert::error('passwords_not_match', true)); 
		endif;
    
        // hash pass
        $hashed_password = password_hash(Request::post('password'), PASSWORD_DEFAULT); //  I need to add a cost to this....
        

        // okay, time to register 'em
		// iniate the database
        $database = DatabaseFactory::getFactory()->getConnection();
		
		// start transaction
		$database->beginTransaction();
		
		// the sql to run
		$register_sql = "INSERT INTO users
						(
							user_email, 
							user_username,
							user_password,
							user_email_code,
							user_emailverified
						) 
						VALUES
						(
							?,
							?,
							?,
							?,
							?
						)";
        
		// run the query
		$register_user = $database->prepare($register_sql);
		$email_code = md5(uniqid());

		//the variables to insert
		$registerInfo = [Request::post('email'), Request::post('username'), $hashed_password, $email_code, REQUIRE_EMAIL_VERIFY];
        
        //insert the info
        $result = $register_user->execute($registerInfo); 
        
		// user id
		$user_id = $database->lastinsertid();
		
		// what was the sql results
        if(!$result):        
            exit(Alert::error('unknown_error', true));
        else:
			
			// success create sessions
			$database->commit();
					
			Session::set('logged_in', 'true');
			Session::set('id', $user_id);
			Session::set('email', Request::post('email'));
					
			if(EMAIL_ENABLED == true):
				/*
				Mail::sendemail($email, 'Welcome to '.SITE_NAME, $firstname.' '.$surname, "You have recently registered to ".SITE_NAME." 
										You can now upload files for other people to download
										Please verify your email: <a href='".Config::get('SITE_URL')."user/verify_email/{$email}/
										{$email_code}'>".Config::get('SITE_URL')."user/verify_email/{$email}/{$email_code}</a>");
				*/
			endif;
					
			//UserModel::newtoken();
			Alert::success('registered', true);							

        endif;
    }

    public static function update_profile()
    {

        $email = isset($_POST['email']) ? $_POST['email'] : '';
        // set the post inputs
        

        $expandedsidebar = (Request::postCheckbox('expandedsidebar')) ? 'enabled' : 'disabled';
        $expandedchat = (Request::postCheckbox('expandedchat')) ? 'enabled' : 'disabled';
        $voicetrading = (Request::postCheckbox('voicecommands')) ? 'enabled' : 'disabled';
        $emailonwithdraw = (Request::postCheckbox('notifywithdraw')) ? 'enabled' : 'disabled';
        $loginnotify = (Request::postCheckbox('loginnotify')) ? 'enabled' : 'disabled';

        /*
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            //  tell the user something went wrong
            Alert::error('passwords_requirements', true);
            die;
        }
		*/

		// iniate the database
        $database = DatabaseFactory::getFactory()->getConnection();

       	// sql to run
		$sql = "UPDATE users 
					SET user_email            = ?, 
						user_sidebaropen      = ?,
						user_chatbaropen      = ?, 
						user_voicecommands    = ?, 
						user_withdraw_notify  = ?,
						user_login_notify     = ?
				WHERE user_id                 = ?";

		// run the sql
        $update = $database->prepare($sql);
        $update->execute
        (
        	array
        	(
	            $email,
	            $expandedsidebar,
	            $expandedchat,
	            $voicetrading,
	            $emailonwithdraw,
	            $loginnotify,
	            Session::get('user_id')
	        )
	    );

        // add message
        NotificationModel::addmessage("You have updated your account information", "You have recently updated your account information. If you did
			not make these changes please contact support <b><u>as soon as possible</u></b>", Session::get('user_id'), "System", "account");
        
        // results?
        if($update->rowCount()):
        	Alert::success('updated_profile', true);
        else:
        	Alert::error('unknown_error', true);
       	endif;
	}

 	public static function Check_Details($type, $details)
    {
		
		// initate db
		$database = DatabaseFactory::getFactory()->getConnection();

		// switch between email, username and id. to check if a user exists or something
		switch($type):
			case 'email':
					// the sql to run
					$details_sql = "SELECT user_id 
									FROM users 
									WHERE user_email = ? 
									LIMiT 1";
					
					// run the query
					$check_user = $database->prepare($details_sql);
					$check_user->execute(array($details));
					$result = $check_user->fetch();
			break;
			case 'username':
					// the sql to run
					$details_sql = "SELECT user_id 
									FROM users 
									WHERE user_username = ?";
									
					// run the query
					$check_user = $database->prepare($details_sql);
					$check_user->execute(array($details));
					$result = $check_user->fetch();  
			break;
			case 'id':
					// the sql to run
					$details_sql = "SELECT user_id 
									FROM users 
									WHERE user_id = ?";
					
					// run the query
					$check_user = $database->prepare($details_sql);
					$check_user->execute(array($details));
					$result = $check_user->fetch();  
			break;
		endswitch;
        
		// what was the results of the query
        if($result):
            return true;       
		endif;
    }

   	public static function update_balance($datanase, $sellersnewbalance, $newbalance, $user)
   	{
 
		// sql to run
		$sql = "UPDATE user 
				SET $currency = ?, 
			    $currency1 = ? 
			    WHERE username=?";

		// run the sql
		$insertbalance = $database->prepare($sql);
        $insertbalance->execute(array($sellersnewbalance, $newbalance, $user));
   	}
}