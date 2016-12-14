<?php
namespace Filtration\Core;

class System extends Controller
{

	
	public static function wysiwyg($str) {
		
		include Config::get('PATH_LIBS').'/Parsedown.php';
		
		$Parsedown = new Parsedown();
		return $Parsedown->text(System::escape($str));
		
		/*
        return strip_tags($str, "
				<br><p><a><img><h1><h2><h3><h4>
				<font><li><ul><table><tr><td><tbody>
				<thead><span><blockquote><b>");*/
    }
	
	public static function JqueryOnly($jquerySet = null)
	{
		//check if the headers were sent across if not, it wasn't called by ajax
		if(isset($jquerySet) && $jquerySet == true):
			if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'):
				Session::set('error', 'unknown_error');
				Redirect::to('dashboard');
			endif;
		endif;
	}

    public static function error_tracking($error_type, $error_file, $error_full_path, $error_line, $error_message, $email = null)
    {
    	//iniate the database
 		$database = DatabaseFactory::getFactory()->getConnection();
  		
  		//the current time
		$timestamp = strtotime("NOW");
		
		//what page they visited from
		$refer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'none';
		
		//browser information
		$browser = $_SERVER['HTTP_USER_AGENT']; 

		//get the users cookies, this may help us fix a few problems ;)
		$user_cookie = isset($_SERVER['HTTP_COOKIE']) ? $_SERVER['HTTP_COOKIE'] : 'none';
		
		//their ip
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

		//who is it doing it?
		$user = Session::get('id') == true ? Session::get('id') : 'guest';

   		$add_error_sql = "INSERT INTO error_tracking
   							(
   								error_type,
   							    error_page,
   								error_full_path,
   								error_line,
   					            error_details,
   					            error_date,
   					            error_timestamp,
   					            error_browser,
   					            error_user,
   					            error_ip,
   					            error_user_cookies
   							)
   							VALUES
   							(
   								?,
   								?,
   								?,
   								?,
   								?,
   								?,
   								?,
   								?,
   								?,
   								?,
   								?
   							)";

		$add_error = $database->prepare($add_error_sql);
		$add_error_result = $add_error->execute(array($error_type, $error_file, $error_full_path, $error_line, 
													  $error_message, date("Y-m-d H:i:s"), $timestamp, $browser, $user, 
													  $ip, $user_cookie));
		
		if(!isset($email)):
		
			
			Mail::sendemail(ERROR_REPORTING_EMAIL, 'System Error', ERROR_REPORTING_NAME, 'File: '. $error_file . '<br>
																			  Type: '. $error_type . '<br>
																			  Full path: '. $error_full_path . '<br>
																			  Error link '. $error_line . '<br>
																			  Error: '. $error_message .'<br>
																			  Date: '. date("Y-m-d H:i:s"));

																		 
		endif;
																		
    }
	
	public static function action_tracking($action = null, $acti_type = null, $goto = null)
	{
		//the current time
		$timestamp = strtotime("NOW");
		
		//the current date
		$date = date("Y-m-d H:i:s"); 
		
		//what page they visited from
		$refer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'none';
		
		//should it go in the activity log?
		$activity_type = isset($acti_type) ? 'activity' : 'system';
		
		//should it go to a specific page?
		$goto_SITE_URL = isset($goto) ? $goto : 'n/a';
		
		//browser information
		$browser = $_SERVER['HTTP_USER_AGENT']; 
		
		//get the users cookies, this may help us fix a few problems ;)
		$user_cookie = isset($_SERVER['HTTP_COOKIE']) ? $_SERVER['HTTP_COOKIE'] : 'none';		
		
		//their ip
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		//who is it doing it?
		$user = Session::get('id') == true ? Session::get('id') : 'guest';
		
		//what action they performed 
		$user_action = isset($action) ? $action : 'unknown'; 
		
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//create the sql query
		$sql = "INSERT INTO action_tracking 
							(
								action_tracking_timestamp, 
								action_tracking_date, 
								action_tracking_reffer, 
								action_tracking_browser, 
								action_tracking_user, 
								action_tracking_action,
								action_tracking_ip,
								action_tracking_user_cookies,
								action_tracking_type,
								action_tracking_goto_SITE_URL
							 ) 
				VALUES      (
				                ?, 
								?,
								?, 
								?, 
								?, 
								?, 
								?,
								?,
								?,
								?
							)";
							
		$inserttracking = $database->prepare($sql);
		
		//insert the values
		$inserttracking->execute(array($timestamp, 
									   $date, 
									   $refer, 
									   $browser, 
									   Session::get('id'), 
									   $user_action, 
									   $ip, 
									   $user_cookie, 
									   $activity_type, 
									   $goto_SITE_URL));
	}	

	
	/*
	 * Sanitise source, 'compile' all code to 'speed' up the website
	*/
	public static function Sanitise()
	{
	    function sanitize_output($buffer) 
		{

            $search = array(
                '/\>[^\S ]+/s', // strip whitespaces after tags, except space
                '/[^\S ]+\</s', // strip whitespaces before tags, except space
                '/(\s)+/s'       // shorten multiple whitespace sequences
            );

            $replace = array(
                '>',
                '<',
                '\\1'
            );

            $buffer = preg_replace($search, $replace, $buffer);

            return $buffer;
        }

        ob_start("sanitize_output");
	}
	
	/*
	 * Escape all database outputs incase they're tryin' to hack us
	*/
	public static function escape($str)
	{
		return htmlspecialchars($str, ENT_QUOTES); //xml -- but the best
		//return htmlentities($str, ENT_QUOTES); //non-xml
	}
	
	
    public static function gettext()
	{
		//include the libs
		include(Config::get('PATH_LIBS')."streams.php");
		include(Config::get('PATH_LIBS')."gettext.php");
		
		//define all the language settings
		define('LOCALE', 'en_GB');
		define('SESSION_LOCALE_KEY', 'locale');
		define('DEFAULT_LOCALE', 'en_GB');
		define('LOCALE_REQUEST_PARAM', 'lang');
		define('WEBSITE_DOMAIN', 'messages');
		
		//check if the language exists
		if(array_key_exists(LOCALE_REQUEST_PARAM, $_REQUEST)):
				$current_locale = $_REQUEST[LOCALE_REQUEST_PARAM];
				$_COOKIE[SESSION_LOCALE_KEY] = $current_locale;
		elseif(array_key_exists(SESSION_LOCALE_KEY, $_COOKIE)):
				$current_locale = $_COOKIE[SESSION_LOCALE_KEY];
		else:
				$current_locale = DEFAULT_LOCALE;
		endif;
		
		//will eventually stick this all in the model file
		putenv("LC_TIM=en_GB");
		putenv("LC_MESSAGES=$current_locale");
		setlocale(LC_ALL, $current_locale);
		
		//bind it all 
		bindtextdomain(WEBSITE_DOMAIN, Config::get('PATH_MAIN').'lang');
		bind_textdomain_codeset(WEBSITE_DOMAIN, 'UTF-8');
		textdomain(WEBSITE_DOMAIN);
	}
	#
	public static function translate($text)
	{
	   return gettext($text); 
	}
	
	//stop people using these words in inputs
	public static function banned_words()
	{
		return array("nigger", "nigga", "wog", "coon", "shit", "fuck", "cunt", "twat", "minge", "kike", "spic", "arse", "ass", "dick", "pussy",
		      "cock", "faggot", "scrotum", "butthole", "tits", "tit", "tities", "wank", "wanker", "turd", "whore", "anal", "anus",
			  "ballsack", "balls", "bastard", "bitch", "bitches", "porch monkey", "bollocks", "bollock", "boner", "boob", "clitoris",
			  "dildo", "buttplug", "dyke", "fag", "fellatio", "feltching", "flange", "jerk", "knobend", "knobhead", "jizz", "labia",
			  "muff", "penis", "piss", "slag", "prick", "smegma", "spunk", "tosser");
	}
	
	public static function languages()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "SELECT * FROM languages";
		
		$languages = $database->prepare($sql);
		$languages->execute();
		
		return $languages->fetchAll();
	}
	
	public static function countries()
	{
		return  array("United Kingdom", "United States", "Afghanistan", "Albania", "Algeria", "American Samoa", 
				    "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", 
				    "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", 
					"Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", 
					"Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", 
					"Bouvet Island", "Brazil", "British Indian Ocean Territory", 
					"Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", 
					"Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", 
					"Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", 
					"Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", 
					"Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", 
					"Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic",
					"East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", 
					"Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", 
					"Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", 
					"French Guiana", "French Polynesia", "French Southern Territories", 
					"Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", 
					"Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", 
					"Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", 
					"Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", 
					"India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", 
					"Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", 
					"Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", 
					"Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", 
					"Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", 
					"Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", 
					"Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", 
					"Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", 
					"Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", 
					"Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", 
					"New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island",
					"Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", 
					"Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", 
					"Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", 
					"Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", 
					"Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", 
					"San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", 
					"Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", 
					"Slovenia", "Solomon Islands", "Somalia", "South Africa", 
					"South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", 
					"St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", 
					"Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", 
					"Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", 
					"Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", 
					"Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", 
					"Tuvalu", "Uganda", "Ukraine", "United Arab Emirates",
					"United States Minor Outlying Islands", "Uruguay", "Uzbekistan", 
					"Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", 
					"Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", 
					"Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
	}

	/**
	 * crypto_rand_secure()
	 * 
	 * @param mixed $min
	 * @param mixed $max
	 * @return
	 */
	public static function crypto_rand_secure($min, $max) {
			$range = $max - $min;
			if ($range < 0) return $min; // not so random...
			$log = log($range, 2);
			$bytes = (int) ($log / 8) + 1; // length in bytes
			$bits = (int) $log + 1; // length in bits
			$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
			do {
				$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
				$rnd = $rnd & $filter; // discard irrelevant bits
			} while ($rnd >= $range);
			return $min + $rnd;
	}

	/**
	 * getToken()
	 * 
	 * @param mixed $length
	 * @return
	 */
	public static function getToken($length){
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		for($i=0;$i<$length;$i++){
			$token .= $codeAlphabet[SELF::crypto_rand_secure(0,strlen($codeAlphabet))];
		}
		return $token;
	}	
	
}

?>