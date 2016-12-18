<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
use Filtration\Core\Session;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;

Class WalletModel
{
	public static function wallet($startcoin, $coin, $generate = null) 
	{
        //sql to run
        $sql = "INSERT INTO addresses
        		(
        			address_address,
        			address_coin,
        			address_user,
        			address_type
        		) 
				VALUES
				(
					?,
					?,
					?,
					'withdraw'
				)";

        //iniate the database
        $database = DatabaseFactory::getFactory()->getConnection();  

		//pre-iniate the sql
		$addwallet = $database->prepare($sql);

        // iniate bit-wasp 
        $network = Bitcoin::getNetwork();

        // master key for the wallet
        $master = HierarchicalKeyFactory::generateMasterKey();
        
        //iniate new address
        $wallet = $master->getPublicKey()->getAddress()->getAddress();
        
        //get their address is they have one
        $wallets = SELF::wallet_address($startcoin);

		//if they want to generate a new address
        if ($generate == 'generate')
        {
            $addwallet->execute(array($wallet, $startcoin, Session::get('user_id')));
            return $wallet;
        }
        else
        {
        	if(!$wallets){
        	   $addwallet->execute(array($wallet, $startcoin, Session::get('user_id')));
        	   return $wallet;
        	}
            else{
        		return $wallets;
            }
        }
        
    }

    public static function wallet_address($coin)
    {
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
    	//sql to run
    	$sql = "SELECT * FROM addresses 
    			WHERE address_user = ? 
    			AND address_coin = ? 
    			AND address_type ='withdraw' 
    			ORDER BY address_date DESC";

    	//run the sql
    	$wallet = $database->prepare($sql);
    	$wallet->execute(array(Session::get('user_id'), $coin));

    	//return the results
    	return $wallet->fetch();
    }
}