<?php
namespace Filtration\Model;

use Filtration\Core\Config;
use Filtration\Core\DatabaseFactory;

Class CoinsModel
{

	/*
	 * rewrite this method
	 */
	public static function btccoin()
	{
	    // iniate the coin in here, use some library, and include via vendor
	    // and then add the namespace to the top of this file and then iniate it
	    // like BitcoinClass\Core\BTC::start(); <--- psuedo code....

	}

    public static function coins() 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();  
		
		//sql to run
		$sql = "SELECT * from settings";
		
		//run the sql
        $coin = $database->prepare($sql);
        $coin->execute();
        
		//get the info
		return $coin->fetch();
        
    }
	
    public static function coin_exists($check_coin = null) 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();  
		
		//sql to run
		$sql = "SELECT * from settings";
		
		//run the sql
        $coin = $database->prepare($sql);
        $coin->execute();
        
		//get the info
        $coins = explode(",", $coin->fetch()->coins);
        
		//return if the coin exists
		return in_array($check_coin, $coins);
    }
}