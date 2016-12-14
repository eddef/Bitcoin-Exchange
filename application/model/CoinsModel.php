<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
Class CoinsModel
{

	public static function btccoin()
	{
	    // require APP . 'libs/easybitcoin.php';
        require Config::get('PATH_LIBS') . 'jsonRPCClient.php'; 
		// $bitcoin = new jsonRPCClient("");
		$bitcoin = new jsonRPCClient("");
	    
	    // return the client
	    return $bitcoin;
	    
	    //echo $bitcoin->getnewaddress();

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