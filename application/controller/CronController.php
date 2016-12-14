<?php

class CronJController extends Controller {

    public function deposits() 
	{
        CronjobModel::new_deposit();
    }

    public function checkneg() 
    {
        /*
         * in the event of a user account going in to the negative balance
         * which I'm sure will NEVER happen, but if it somehow managed to
         * Disable the account, and notify me and then I can check the account 
         * and check if it was a mistake or a hack, and then fix it 
         */
    }

}

?>