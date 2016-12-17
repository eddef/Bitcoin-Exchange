<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
use Filtration\Core\Session;

Class ActivityModel
{
	public static function timeline() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM trades 
				WHERE trade_user = ?";
				
		//run the sql
        $query = $database->prepare($sql);
        $query->execute(array(Session::get('user_id')));
		
		//return the results
        return $query->fetchAll();
    }
}