<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;

Class PayeeModel
{
	public static function add_payee()
	{
		
        switch (Request::post('coin')):
            case 'Bitcoin':
                $coins = 'btc';
                break;
            case 'Litecoin':
                $coins = 'ltc';
                break;
        endswitch;

        
		//sql to run
		$sql = "INSERT INTO addresses
				(
					address,
					coin,
					name,
					type,
					date,
					username
				)
				VALUES
				(
					?,
					?,
					?,
					?,
					?,
					?
				)";
				
		//run the sql
        $addpayee = $database->prepare($sql);
        $addpayee->execute(array($address, $coins, $name, 'payee', $date, $username->username));
               
	}
}