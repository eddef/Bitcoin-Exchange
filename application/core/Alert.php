<?php

namespace Filtration\Core;

class Alert
{

	/*
	 * Show errors to the user to make it more user-friendly
	*/
	public static function error($errorid, $jqueryError = null, $param = null) 
	{
	
		// create an array of error messages
        $errors = array
        (
        	'unknown_error' => 'There was an unknow error. This was our fault, not yours',
			'account_exists' => 'Account with that email and/or username already exists',
			'account_not_exist' => 'Account with that email does not exist.',
			'wrong_info_login' => 'The account information does not match, try again.',
			'website_not_exist' => 'Sorry. You are not the owner of that domain. Please try another.',
			'login_disabled_brute_force' => 'You cannot login. Too many failed attemps',
			'ip_not_match' => 'Your IP does not match a whitelisted IP',
			'wrong_email_or_password' => 'There details you entered do not match our system records',
			'passwords_not_match' => 'Passwords do not match, try again',
			'generate_api' => 'There was an error generating an API key',
			'delete_api' => 'Error deleting API'
		);

		
		// show different types of errors, json or plain text
		if(isset($errors[$errorid]) && $jqueryError == true && $param == null)
		{
			header("Content-Type: text/json; charset=utf8");
			//return jquery error
			exit(json_encode(array("success" => false, "error" => $errors[$errorid])));

		}//form validation
		elseif($errorid == false && $jqueryError == true && isset($param))
		{		
			header("Content-Type: text/json; charset=utf8");
			//return jquery success
			exit(json_encode(array("success" => false, "error" => $param)));			
        }
    }

    /*
	 * Show success messages to the user to make it more user-friendly
    */
    public static function success($successid = null, $jquerySuccess = null) 
	{
		
        $success = array
        (
			'logged_in' => 'You have successfully logged in',
			'registered' => 'You have registered',
			'generate_api' => 'You have generated an API',
			'delete_api' => 'You have deleted this API'
        );
		
	    if (isset($success[$successid]) && $jquerySuccess != true)
	    {
	    	// set the success message
            return $success[$successid];
        }
		elseif(isset($success[$successid]) && $jquerySuccess == true)
		{	
			header("Content-Type: text/json; charset=utf8");
			//return jquery success
			exit(json_encode(array("success" => $success[$successid], "error" => false)));		
		}
	}

	public static function getMessage()
	{
		if(Session::get('success'))
		{
			echo '<div class="alert alert-success">
					<strong>Success!</strong> '.SELF::success(Session::get('success')).'
				</div>';

			// unset the success
			unset($_SESSION['success']);
		}
		elseif(Session::get('error'))
		{
			echo '<div class="alert alert-error">
					<strong>Error!</strong> '.SELF::error(Session::get('error')).'
				</div>';

			// unset the error
			unset($_SESSION['error']);
		}
	}

}