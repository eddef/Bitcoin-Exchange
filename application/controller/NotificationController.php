<?php

Class NotificationController extends Controller
{
	public function view($notification) 
	{
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();

		//get the message
		NotificationModel::read_notification($notification);
		
        $message = NotificationModel::message($notification);
        
    $this->View->RenderPage_sidebar('messages/view', array('message' => $message));
    }


    public function messages($type = null) 
	{ 
		//make sure they're logged in
		UserModel::authentication();
		
		//get notifications
        $messages = NotificationModel::messages($type);
		
		$this->View->RenderPage_sidebar('messages/messages', array('messages' => $messages));
    }

    public function delete_message($message = null) 
	{
		//make sure they're logged in
		UserModel::authentication();

        $message = NotificationModel::delete_message($message);
    }
}