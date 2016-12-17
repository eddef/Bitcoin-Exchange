<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
use Filtration\Core\Session;

Class SupportModel
{
	public static function helpguides() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT guide_title, 
					   guide_id
				FROM userguides";
        
		//run the sql
		$getguide = $database->prepare($sql);
        $getguide->execute();
        
		//return the results
		return $getguide->fetchAll();
    }
	
    public static function faqs() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM faq";
		
		//run the sql
        $faqs = $database->prepare($sql);
        $faqs->execute();
        
		//return the results
		return $faqs->fetchAll();
    }
	
    public function viewguide($id) 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT guide_message, 
					   guide_id, 
					   guide_title 
				FROM userguides 
				WHERE guide_id = ?";
				
		//run the sql
        $getguide = $database->prepare($sql);
        $getguide->execute(array($id));
		
		//return the result
		return $getguide->fetch();
      
    }
	
	public function tickets($type = null, $admin = null) 
	{
		
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
        if (isset($type)):
		
			//sql to run
			$sql = "SELECT * FROM support 
					WHERE support_user = ? 
					AND support_status = ? 
					ORDER BY support_lastupdate DESC";
			
			//run the sql
            $tickets = $database->prepare($sql);
            $tickets->execute(array(Session::get('user_id'), $type));
        else:
		
			//sql to run
			$sql2 = "SELECT * FROM support 
					WHERE support_user = ? 
					ORDER BY support_lastupdate DESC";
			
			//run the sql
            $tickets = $database->prepare($sql2);
            $tickets->execute(array(Session::get('user_id')));
        endif;
        if (isset($admin)):
		
			//sql to run
			$sql3 = "SELECT * FROM support 
					ORDER BY support_lastupdate DESC";
					
			//run the sql
            $tickets = $database->prepare($sql3);
            $tickets->execute();
        endif;
        
		//return the results
		return $tickets->fetchAll();
    }

    public function ticket($user, $id) 
	{
		
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
        if (!empty($user)):
		
			//sql to run
			$sql = "SELECT * FROM support 
					WHERE support_user = ? 
					AND support_id = ?";
			
			//run the sql
            $tickets = $database->prepare($sql);
            $tickets->execute(array($user, $id));
        else:
		
			//sql to run
			$sql2 = "SELECT * FROM support 
					WHERE support_id=?";
			
			//run the sql
            $tickets = $this->db->prepare($sql2);
            $tickets->execute(array($id));
        endif;
		
		//return the results
        return $tickets->fetch();
    }

    public static function ticketreplies($id) 
	{
		
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM tickets 
				WHERE ticket_mainticket = ?";
		
		//run the sql
        $tickets = $this->db->prepare($sql);
        $tickets->execute(array($id));
        
		//return the results
		return $tickets->fetchAll();
    }

    public function addticket() 
	{
		
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $categories = isset($_POST['category']) ? $_POST['category'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';

        switch ($categories):
            case 'account':
                $category = 'Account';
                break;
            case 'general':
                $category = "General";
                break;
            case 'technical':
                $category = "Technical";
                break;
            default:
                $category = 'Other';
        endswitch;
		
		//sql to run
		$sql = "INSERT INTO support
				(
					support_title,
					support_category,
					support_priority,
					support_message,
					support_user,
					support_lastupdate,
					support_date
				) 
				VALUE
				(
					?,
					?,
					?,
					?,
					?,
					?,
					?
				)";
				
				
        $addticket = $this->db->prepare($sql);
        $addticket->execute(array($title, $category, $status, $message, $user, $date, $date));
      
    }
	
	public static function manage_ticket($ticket, $type)
	{
		
		//open or close
		($type == 'open') ? $manage = 'open' : $manage = 'closed'; 
		
		//sql to run
		$sql = "UPDATE support 
				SET support_status= ?  
				WHERE support_id = ?";
                
		//run the sql		
		$update = $database->prepare($sql);
		$update->execute(array($manage, $ticket));
	}
	
	public static function ticket_reply($ticket)
	{
		if(!SupportModel::ticket($ticket, Session::get('user_id'))):
			//doesn't exist or belong to them
		endif;
           
		//sql to run
		$sql = "INSERT INTO tickets
				(
					ticket_message,
					ticket_user,
					ticket_date,
					ticket_mainticket
				) 
				VALUE
				(
					?,
					?,
					?,
					?
				)";
		
		//run the sql
        $addticket = $this->db->prepare($sql);
        $addticket->execute(array($message, $user, $date, $ticket));
        
		//the results?
		if($addticket->rowCount()):
			
			//update main ticket last activity date
			SupportModel::lastactivity($ticket);
			
			//success message
		else:
			//error message
		endif;
	}
	
	public static function lastactivity($ticket)
	{
		//sql to run
		$sql = "UPDATE support 
				SET support_lastupdate = ? 
				WHERE support_id = ?";
		
		//run the sql
		$lastupdate = $this->db->prepare($sql);
        $lastupdate->execute(array(date("Y-m-d H:i:s"), $ticket));
	}
}