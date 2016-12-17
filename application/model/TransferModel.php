<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;

Class TransferModel
{
	public static function transaction($market, $type) 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
		$sql = "SELECT * FROM transactions 
				WHERE transaction_user = ? 
				AND transaction_market = ? 
				AND transaction_transaction = ?
				ORDER BY transaction_date DESC";

		//run the sql
        $transaction = $database->prepare($sql);
        $transaction->execute(array(Session::get('user_id'), $market, $type));
        
        //return the results
        return $transaction->fetchAll();
    }

    public static function payees($coin) 
    {
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
    	//sql to run
    	$sql = "SELECT * FROM addresses 
    			WHERE address_user = ? 
    			AND address_coin = ? 
    			AND address_type = 'payee'";

    	//run the sql
        $address = $database->prepare($sql);
        $address->execute(array(Session::get('user_id'), $coin));
        
        //return the results
        return $address->fetchAll();
    }
}