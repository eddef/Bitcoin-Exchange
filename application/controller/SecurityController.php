<?php
namespace Filtration\Controller;

use Filtration\Model\UserModel;
use Filtration\Model\SecurityModel;

Class SecurityController extends \Filtration\Core\Controller
{
    public function addwhitelistip() 
	{
		//make sure they're logged in
		UserModel::authentication();
		
		SecurityModel::add_ip_whitelist();
    }

	public function deleteipwhitelist($ip = null) 
	{
		//make sure they're logged in
		UserModel::authentication();
		
		//get user's infp
        $user = UserModel::user();

		//new list
        $newwhitelist = str_replace($ip, "", $user->user_ipwhitelist);
        
		//update new ip whitelist
		SecurityModel::updatenewwhitelist($newwhitelist);
    }


    public function verifyidentity() 
    {
        $uploaddir = '/userverify';
        $uploadfile = $uploaddir . basename($_FILES['advancedDropzone']['name']);
        echo "<p>";
        if (move_uploaded_file($_FILES['advancedDropzone']['tmp_name'], $uploadfile)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Upload failed";
        }
    }

    public function security() 
	{
         //make sure they're logged in
        UserModel::authentication();

        //get the user
        $user = UserModel::user();

		//get user's whitelist ips and logins to their account
        $whitelistips = $user->user_ipwhitelist;
        $userlogins = SecurityModel::userlogins();
		
		$this->View->Render('security/security', ['whitelistips' => $whitelistips, 'userlogins' => $userlogins]);
        
    }

 	public function twofactor() 
    {
    	//make sure they're logged in
        UserModel::authentication();

        //get the user
        $user = UserModel::user();

        //include the library
        require Config::get('PATH_LIBS') . 'GoogleAuthenticator.php';
        
        //iniate the class
        $ga = new PHPGangsta_GoogleAuthenticator();
        
        //get the user's secret key
        $secret = SecurityModel::twofackey($user);

		$this->View->RenderPage_sidebar('security/twofactor', array('secret' => $secret, 'user' => $user, 'ga' => $ga));
	}

	public function twofactor_action()
	{
    	//make sure they're logged in
        UserModel::authentication();
        
        //get the user
        $user = UserModel::user();

        //include the library
        require Config::get('PATH_LIBS') . 'GoogleAuthenticator.php';
        
        //iniate the class
        $ga = new PHPGangsta_GoogleAuthenticator();
        
        //get the user's secret key
        $secret = SecurityModel::twofackey($user);

        //get the code
		$oneCode = $ga->getCode($secret);
		
        SecurityModel::add_2factor($oneCode, $secret);	
	}
}