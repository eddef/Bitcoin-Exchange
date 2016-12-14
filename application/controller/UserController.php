<?php
namespace Filtration\Controller;

use Filtration\Model\UserModel;
use Filtration\Core\FormValidation; 
use Filtration\Core\Alert;
use Filtration\Model\ActivityModel;

class UserController extends \Filtration\Core\Controller 
{

	public function login()
	{
		$this->View->RenderMulti(['_templates/header', 'user/login']);
	}

    public function register() 
	{
        // get the refer so we can log them back to that place
        $referer = isset($_GET['referer']) ? htmlentities($_GET['referer'], ENT_QUOTES) : '';
		
		$this->View->RenderMulti(['_templates/header','user/register']);
    }

    public function edit() 
	{
        //make sure they're logged in
        UserModel::authentication();

        //get the user's information 
        $user = UserModel::user();

		$this->View->Render('user/edit', ['user' => $user]);
    }

    public function information() 
	{
        //make sure they're logged in
        UserModel::authentication();

		//get the activity
		$timeline = ActivityModel::timeline();
		
        $this->View->Render('user/timeline', ['timeline' => $timeline]);
    }
	
	
    public function login_action() 
	{
        // Let's define the rules and filters
        $rules = array(
            'mail'    => 'valid_email|required',
            'password' => 'required'
        );
            
        
        //validate the info
        $validated = FormValidation::is_valid($_POST, $rules);
        
        // Check if validation was successful
        if($validated !== TRUE):    
                                   
            //exit with an error
            exit(Alert::error(false, true, $validated));

        endif;

        // they've passed the filter login try and log 'em in
		UserModel::login();        
    }

    public function register_action() 
	{
        UserModel::register();
    }
	
    public function editinformation() 
    {
         //make sure they're logged in
        UserModel::authentication();
        
        //get the session user
        $user = UserModel::user();

        UserModel::update_profile();
    }

    public function logout() 
    {
        session_start();
        session_unset();
        session_destroy();

        //PUT THAT COOKIE DOWN, NOW! (Arnie reference)
        if (isset($_COOKIE['XE_RememberMe'])) {
            unset($_COOKIE['XE_RememberMe']);
            setcookie('XE_RememberMe', null, -1, '/');
        }
        Redirect::to('home');
        exit();
    }


    public function veridetails() 
	{
		//make sure they're logged in
		UserModel::authentication();
		
		VerifyModel::upload_id();
    }

    public function activationcode() 
    {
        SESSION_START();
        $user = isset($_GET['user']) ? $_GET['user'] : '';
        $code = isset($_GET['code']) ? $_GET['code'] : '';

        if (isset($code) && isset($user)) {
            $this->model->activatecode($code, $user);
        }
    }

    public function passreset() 
    {


        $email = isset($_POST['email']) ? $_POST['email'] : '';
        if (empty($email)) {
            require APP . 'views/user/passreset.php';
        }
        $secanswer = isset($_POST['secanswer']) ? $this->model->encrypt($_POST['secanswer']) : '';
        $secanswer2 = isset($_POST['secanswer2']) ? $this->model->encrypt($_POST['secanswer2']) : '';
        if (!empty($email)) {

            $selectuser = $this->db->prepare("SELECT username,email,
			security_question1,security_answer1,security_question2,
            security_answer2 FROM user WHERE email=?");
            $selectuser->execute(array($this->model->encrypt($email)));
            $user = $selectuser->fetch();
            if ($user) {
                if (isset($_POST['submit'])) {
                    if ($secanswer == $user->security_answer1 && $secanswer2 == $user->security_answer2) {
                        echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-success">
					  <strong>Password Reset!</strong> Please check your email
					  </div>
					  </div>
					  </div>';
                        $pass = uniqid();

                        function rand_string($length) {
                            $str = "";
                            $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                            $size = strlen($chars);
                            for ($i = 0; $i < $length; $i++) {
                                $str .= $chars[rand(0, $size - 1)];
                            }
                            return $str;
                        }

                        $site_salt = "subinsblogsalt";
                        $p_salt = rand_string(20);
                        $salted_hash = hash('sha256', $pass . $site_salt . $p_salt);
                        $update = $this->db->prepare("UPDATE user SET password=?, passwordsalt=? WHERE email=?");
                        $update->execute(array($salted_hash, $p_salt, $this->model->encrypt($email)));
                        //update site message to let the user know

                        $this->model->sendemail($email, 'Password Reset', '
					You have applied for a password reset your new password is ' . $pass . ' 
					Please change this default password <u><b>as soon as possible</b></u>', $site);
                        $this->model->addmessage("Password Reset", "You have recently changed your password. If you did not do
					this please contact support <u><b>as soon as possible</b></u>", $user, "System", "account");
                    } else {
                        echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Wrong security answers
					  </div>
					  </div>
					  </div>';
                    }
                }
                require APP . 'views/user/passresetsec.php';
            } else {
                echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Email is not associated with an account
					  </div>
					  </div>
					  </div>';
                require APP . 'views/user/passreset.php';
            }
        }
        require APP . 'views/_templates/footer.php';
    }

    public function twofactor() 
    {

        require APP . 'libs/GoogleAuthenticator.php';
        $ga = new PHPGangsta_GoogleAuthenticator();
        $secret = $this->model->twofackey($user->username);
        $userkey = isset($_POST['2key']) ? $_POST['2key'] : '';
        $usercode = isset($_POST['2code']) ? $_POST['2code'] : '';
        $oneCode = $ga->getCode($secret);
        if ($user->twofactor == 1) {
            header('location: ' . SITE_URL . 'dashboard');
            exit();
        }
        require APP . 'views/user/twofactor.php';
        if (isset($userkey) && isset($usercode)) {
            if ($usercode == $oneCode && $userkey == $secret) {
                $checkResult = $ga->verifyCode($secret, $oneCode, 2);
                if ($checkResult) {
                    $updateuser = $this->db->prepare("UPDATE user SET twofactor=? WHERE username=?");
                    $updateuser->execute(array('1', $user->username));
                    $this->model->newtoken();
                    $this->model->addmessage("You have completed 2factor Authentication", "You have added Two Factor Authentication to your account. This will
					make your account much more secure", $user, "System", "account");

                    echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-success">
					  <strong>Well done</strong> Two Factor Authentication Complete
					  </div>
					  </div>
					  </div>';
                } else {
                    echo 'FAILED';
                }
            }
        }
        require APP . 'views/_templates/footer.php';
    }


}
