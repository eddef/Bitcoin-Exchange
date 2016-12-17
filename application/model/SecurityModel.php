<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;

Class SecurityModel
{
	public static function is_positive_integer($str) 
	{
	  return (is_numeric($str) && $str > 0 && $str == round($str));
	}

    public static function userlogins() 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//get the users info
		$user = UserModel::user();
		
		//sql to run
		$sql = "SELECT * FROM logins 
				WHERE login_email = ? 
				ORDER BY login_date DESC";
				
		//run the sql
        $login = $database->prepare($sql);
        $login->execute(array($user->user_email));
        
		//return the results
		return $login->fetchAll();
    }
	
	public static function add_ip_whitelist()
	{
		
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//users information 
		$user = UserModel::user();

		//ips
		$ips = $user->user_ipwhitelist .','. Request::post('ipwhitelist');
		
		//sql to run
		$sql = "UPDATE users
				SET user_ipwhitelist = ? 
				WHERE user_id = ?";
		
		//run the sql
        $updateips = $database->prepare($sql);
        $updateips->execute(array($ips, Session::get('user_id')));
		
		//the results?
		if($updateips->rowCount()):
			
			//send them an account message
			NotificationModel::addmessage("You have added a whitelist IP", "You have recently added a whitelist IP from our system. You will no longer be
				able to login with another IP unless you add them too. The IP that was deleted 
				is: " . $ips . "", Session::get('user_id'), "System", "account");
				
			Session::set('success', 'update_whitelist');
			Redirect::to('security/security');
		else:
			Session::set('error', 'update_whitelist');
			Redirect::to('security/security');
		endif;
    }

    public static function updatenewwhitelist($newwhitelist) 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();

		//users information 
		$user = UserModel::user();
		
		//sql to run
		$sql = "UPDATE users
				SET user_ipwhitelist = ? 
				WHERE user_id = ?";
		
		//run the sql
        $updateips = $database->prepare($sql);
        $updateips->execute(array($newwhitelist, Session::get('user_id')));
		
		//the results?
		if($updateips->rowCount())
		{
			//send them an account message
	        NotificationModel::addmessage
	    	(
	    		"You have deleted a whitelist IP", 
	    		"You have recently delete a whitelist IP from our system. 
				 You will no longer be able to login with that IP if you have another IP set. 
				 The IP that was deleted is: " . $newwhitelist . "", $user->user_id, "System", "account"
			);

			Alert::success('update_whitelist', true);
		}else{
			Alert::error('update_whitelist', true);
		}
    }

    public static function add_2factor($oneCode, $secret)
    {
    	if (Request::post('2key') == true && Request::post('2code') == true) 
    	{
            if (Request::post('2code') == $oneCode && Request::post('2key') == $secret) 
            {

            	//check the codes match
                $checkResult = $ga->verifyCode($secret, $oneCode, 2);
                
                //did the results match?
                if ($checkResult) 
                {

                	//sql to run
                	$sql = "UPDATE users 
                			SET user_twofactor =? 
                			WHERE user_id = ?";

                	//run the sql
                    $updateuser = $this->db->prepare($sql);
                    $updateuser->execute(array('enabled', $user->username));
                    
                    //the results?
                    if($updateuser->rowCount())
                    {
	                    //send them a notification to let them know they have added 2factor authentication
	                    NotificationModel::addmessage
	                    (
	                    	"You have completed 2factor Authentication", 
	                    	"You have added Two Factor Authentication to your account. This will
							 make your account much more secure. If you did not do this please contact
							 support as soon as possible", Session::get('user_id'), "System", "account"
						);

						Alert::success('adding_2factor', true);
					}else{
						Alert::error('adding_2factor', true);
					}
                   
                } else {
                    Alert::error('adding_2factor', true);
                }
            }
        }
    }

    public static function twofackey($user) 
    {
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();

    	/**
    	 * if their account doesn't have a
    	 * key generate one for them
    	 */
    	
        if (!empty($user->user_twofackey)) {
            return $user->user_twofackey;
        } else {
            $ga = new PHPGangsta_GoogleAuthenticator();
            $secret = $ga->createSecret();

            //sql to run
            $sql = "UPDATE users 
            		SET user_twofackey = ? 
            		WHERE user_id = ?";

            //run the sql
            $insertkey = $database->prepare($sql);
            $insertkey->execute(array($secret, Session::get('user_id')));
            
            //return the generated key
            return $secret;
        }
    }
    
}