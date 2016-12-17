<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
use Filtration\Core\Session;
Class NotificationModel
{

    public static function notificationcount() 
	{
		//get the user
		$user = UserModel::user();
		
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
        
		//sql to run
		$sql = "SELECT notification_read 
				FROM notifications
				WHERE notification_read = 'unread' 
				AND notification_user = ?";
        
		//run the sql
		$notifications = $database->prepare($sql);
        $notifications->execute(array(Session::get('user_id')));
        
        //return the results
        $notificationcount = $notifications->fetchAll();
    }
	
    public static function notifications($type) 
	{
		
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
        
		if (!empty($type)) {
			
			//sql to run
			$sql = "SELECT * FROM notifications
					WHERE notification_user = ? 
					AND notification_type = ? 
					ORDER BY notification_DATE DESC";
            
			//run the sql
			$notifications = $database->prepare($sql);
            $notifications->execute(array(Session::get('user_id'), $type));
        } else {
			
			//sql to run
			$sql_2 = "SELECT * FROM notifications 
					  WHERE notification_user = ? 
					  ORDER BY notification_DATE DESC";
            
			//run the sql
			$notifications = $database->prepare($sql_2);
            $notifications->execute(array(Session::get('user_id')));
        }
        return $notifications->fetchAll();
    }

    public static function delete_notification($notificationid) 
    {
        //iniate the database
        $database = DatabaseFactory::getFactory()->getConnection(); 

        //sql to run
        $sql = "DELETE FROM notifications
                WHERE notification_user = ? 
                AND notifications_id = ?";

        //run the sql
        $notification = $database->prepare($sql);
        $notification->execute(array(Session::get('user_id'), $notificationid));

        //results?
        if($notification->rowCount()):
            Alert::success('deleted_notification', true);
        else:
            Alert::error('deleted_notification', true);
        endif; 
    }

	public static function read_notification($notification)
	{
		
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
		$sql = "UPDATE notifications
				SET notification_read = 'read' 
				WHERE notification_id = ? 
				AND notification_user = ?";
		
		//run the sql
        $markasread = $database->prepare($sql);
        $markasread->execute(array($notification, Session::get('user_id')));
        
	}

    public static function addnotification($title, $usernotification, $user, $userfrom, $type) 
    {
		//iniate the database
        $database = DatabaseFactory::getFactory()->getConnection();

        //sql to run
        $sql = "INSERT INTO notifications
        		(
        			notification_title,
        			notification_message,
        			notification_user,
        			notification_whofrom,
        			notification_type
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
        $notification = $database->prepare($sql);
        $notification->execute(array($title, $usernotification, $user, $userfrom, $type));
    }

    public static function notification($notificationid) 
    {
		//iniate the database
        $database = DatabaseFactory::getFactory()->getConnection();

    	//sql to run
    	$sql = "SELECT * FROM notifications 
    			WHERE notification_user = ? 
    			AND notification_id = ?";

    	//run the sql
        $notification = $database->prepare($sql);
        $notification->execute(array(Session::get('user_id'), $notificationid));
        
        //return the results
        return $notification->fetch();
    }
}