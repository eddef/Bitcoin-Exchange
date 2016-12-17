<?php
namespace Filtration\Controller;

use Filtration\Model\UserModel;
use Filtration\Model\NotificationModel;

Class NotificationController extends \Filtration\Core\Controller
{
	public function view($notification) 
	{
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();

		//get the notification
		NotificationModel::read_notification($notification);
		
        $notification = NotificationModel::notification($notification);
        
    $this->View->Render('notification/view', array('notification' => $notification));
    }


    public function notifications($type = null) 
	{ 
		//make sure they're logged in
		UserModel::authentication();
		
		//get notifications
        $notifications = NotificationModel::notifications($type);
		
		$this->View->Render('notifications/notifications', array('notifications' => $notifications));
    }

    public function delete_notification($notification = null) 
	{
		//make sure they're logged in
		UserModel::authentication();

        $notification = NotificationModel::delete_notification($notification);
    }
}