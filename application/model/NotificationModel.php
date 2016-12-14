<?php

Class NotificationModel
{

    public static function messagecount() 
	{
		//get the user
		$user = UserModel::user();
		
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
        
		//sql to run
		$sql = "SELECT message_message_read 
				FROM messages 
				WHERE message_message_read = 'unread' 
				AND message_user = ?";
        
		//run the sql
		$messages = $database->prepare($sql);
        $messages->execute(array(Session::get('id')));
        
        //return the results
        $messagecount = $messages->fetchAll();
    }
	
    public static function messages($type) 
	{
		
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
        
		if (!empty($type)) {
			
			//sql to run
			$sql = "SELECT * FROM messages 
					WHERE message_user = ? 
					AND message_type = ? 
					ORDER BY message_DATE DESC";
            
			//run the sql
			$messages = $database->prepare($sql);
            $messages->execute(array(Session::get('id'), $type));
        } else {
			
			//sql to run
			$sql_2 = "SELECT * FROM messages 
					  WHERE message_user = ? 
					  ORDER BY message_DATE DESC";
            
			//run the sql
			$messages = $database->prepare($sql_2);
            $messages->execute(array(Session::get('id')));
        }
        return $messages->fetchAll();
    }

    /**
     * deletemessage()
     * 
     * @param mixed $username
     * @param mixed $messageid
     * @return
     */
    public static function delete_message($messageid) 
    {
        //iniate the database
        $database = DatabaseFactory::getFactory()->getConnection(); 

        //sql to run
        $sql = "DELETE FROM messages 
                WHERE message_user = ? 
                AND message_id = ?";

        //run the sql
        $message = $database->prepare($sql);
        $message->execute(array(Session::get('id'), $messageid));

        //results?
        if($message->rowCount()):
            Alert::success('deleted_message', true);
        else:
            Alert::error('deleted_message', true);
        endif; 
    }

	public static function read_notification($notification)
	{
		
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
		$sql = "UPDATE messages 
				SET message_message_read = 'read' 
				WHERE message_id = ? 
				AND message_user = ?";
		
		//run the sql
        $markasread = $database->prepare($sql);
        $markasread->execute(array($notification, Session::get('id')));
        
	}

    /**
     * addmessage()
     * 
     * @param mixed $title
     * @param mixed $usermessage
     * @param mixed $user
     * @param mixed $userfrom
     * @param mixed $type
     * @return
     */
    public static function addmessage($title, $usermessage, $user, $userfrom, $type) 
    {
		//iniate the database
        $database = DatabaseFactory::getFactory()->getConnection();

        //sql to run
        $sql = "INSERT INTO messages
        		(
        			message_title,
        			message_message,
        			message_user,
        			message_whofrom,
        			message_type
        		) 
        		VALUES
        		(
        			?,
        			?,
        			?,
        			?,
        			?
        		)";

        //run the sql
        $message = $database->prepare($sql);
        $message->execute(array($title, $usermessage, $user, $userfrom, $type));
    }

    /**
     * message()
     * 
     * @param mixed $username
     * @param mixed $messageid
     * @return
     */
    public static function message($messageid) 
    {
		//iniate the database
        $database = DatabaseFactory::getFactory()->getConnection();

    	//sql to run
    	$sql = "SELECT * FROM messages 
    			WHERE message_user = ? 
    			AND message_id = ?";

    	//run the sql
        $message = $database->prepare($sql);
        $message->execute(array(Session::get('id'), $messageid));
        
        //return the results
        return $message->fetch();
    }
}