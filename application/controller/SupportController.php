<?php

class SupportController extends Controller {

    public function index($type = null) 
	{
 		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();

        //switch between open and closed
        switch ($type):
            case 'open':
                $tickets = SupportModel::tickets('open');
                break;
            case 'closed':
                $tickets = SupportModel::tickets('closed');
                $type = '';
                break;
            default:
                $tickets = SupportModel::tickets();
        endswitch;

		$this->View->RenderPage_sidebar('support/index', array('ticket' => $tickets));
    }

    public function newticket() 
	{	
 		//make sure they're logged in
		UserModel::authentication();
		
		$this->View->RenderPage_sidebar('support/new', array('ticket' => $tickets));
    }
	
	public function new_ticket_action()
	{
 		//make sure they're logged in
		UserModel::authentication();
		
        $addticket = SupportModel::addticket($title, $category, $status, $message, $user->username);
			
	}

    public function admin() 
	{
 		//make sure they're logged in
		UserModel::authentication();
		
		//get all the tickets
		$tickets = $this->model->tickets($user->username, '0', 'all');		
		
		$this->View->RenderPage_sidebar('upport/index', array('tickets' => $tickets)

    }

    public function ticket()
	{
 		//make sure they're logged in
		UserModel::authentication();
		
        //is staff, above all peasants
        if ($this->model->isstaff() == true):
            $tickets = SupportModel::model->ticket('', $id);
        else:
            $tickets = SupportModel::ticket($user->username, $id);
        endif;
        
		
		//get the ticket replies
		$ticketreply = SupportModel::ticketreplies($id);

        $this->View->RenderPage_sidebar('support/ticket');
    }

    public function reply() 
	{
		
 		//make sure they're logged in
		UserModel::authentication();
		
		SupportModel::ticket_reply();
    }

    public function resolved($ticket = null, $type = null)
	{
		
		//check if admin
		
 		//make sure they're logged in
		UserModel::authentication();
		
		//manage the ticket
		SupportModel::manage_ticket($ticket, $type);

    }

}

?>