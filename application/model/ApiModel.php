<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
use Filtration\Core\Session;
use Filtration\Core\System;
use Filtration\Core\Request;
use Filtration\Core\Alert;

Class ApiModel
{

    public static function ticker($type, $market, $buysell, $order = null) 
    {
    	// iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();

		// sql to run
		$sql = "SELECT {$type} FROM trades 
				WHERE trade_market = ? 
				AND trade_buysell = ?
				{$order}";

		// run the sql
        $tickersHigh = $database->prepare($sql);
        $tickersHigh->execute(array(strtolower($market), $buysell));
        
        // fetch the results
        $tickerHigh = $tickersHigh->fetch();

        // return the results
        return $tickerHigh->{$type};
    }

    public static function checkapi($data, $message) 
    {
    	// the user's Signature
        $userkey = $data['sig'];

        // The user's Public API Key
        $pubkey = $data['pubkey'];
		
		// iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();
       
        //sql to run
        $sql = "SELECT * FROM api 
        		WHERE api_pubkey = ?";

        //run the sql
        $key = $database->prepare($sql);
        $key->execute(array($pubkey));
        
        //get the results
        $priv_key = $key->fetch();
        
        // check the results
        if (!$priv_key): 
        	return false;
        endif;

        // Data submitted
        $computed_signature = base64_encode(hash_hmac('sha1', $message, $priv_key->api_secret, TRUE));
        if ($computed_signature == $userkey) 
        {
            return $priv_key->api_user;
        } 
        else {
            return false;
        }
    }

    public static function getapi()
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM api 
				WHERE api_user = ?";
		
		//run the sql
        $getapi = $database->prepare($sql);
        $getapi->execute(array(Session::get('user_id')));
        
		//return the results
		return $getapi->fetchAll();
    }
	
	public static function delete_api($api)
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "DELETE FROM api 
				WHERE api_id = ? 
				AND api_user = ?";
		
		//run the sql
        $deleteapi = $database->prepare($sql);
        $deleteapi->execute(array($api, Session::get('user_id')));

        // did it successfully delete?
        if($deleteapi)
        {
        	Alert::success('delete_api', true);
        }

        Alert::error('delete_api', true);
	}
	
    public static function createapi() 
	{
		// Generate API key
        $key = System::getToken("25");
        
        // Generate API secrect key
        $secrect = System::getToken("50");
       
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();
		
		// sql to run
		$sql = "INSERT INTO api
				(
					api_name,
					api_pubkey,
					api_secret,
					api_user
				) 
				VALUES
				(
					?,
					?,
					?,
					?
				)";
				
		// run the sql
        $insertapi = $database->prepare($sql);
        $insertapi->execute(array(Request::post('name'), $key, $secrect, Session::get('user_id')));
		
		// the results?
		if($insertapi->rowCount()):
			Alert::success('generate_api', true);
		else:
			Alert::error('generate_api', true);
		endif;
    }

}