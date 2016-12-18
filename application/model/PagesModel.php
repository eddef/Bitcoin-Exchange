<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;

Class PagesModel
{
    public static function viewpage($id) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();	
		
		//sql to run 
		$sql = "SELECT page_body, 
					   page_title 
				FROM pages 
				WHERE page_SURL = ?";
		
		//run the sql
        $getpage = $database->prepare($sql);
        $getpage->execute(array($id));
        
        //return the results
		return $getpage->fetch();

    }
}