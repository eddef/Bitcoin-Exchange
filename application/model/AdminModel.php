<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
use Filtration\Core\Session;

Class AdminModel
{
	public static function auth()
	{
		//make sure they're an admin
		if(!UserModel::user_role('admin')):
			Redirect::to('dashboard');
		endif;
	}
    public static function unban($user) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "DELETE FROM banlist 
				WHERE ban_user = ?";
		
		//run the sql
        $unban = $database->prepare($sql);
        $unban->execute(array($user));
    }

    public function addnews($title, $message, $url) 
    {
    	//sql to run
    	$sql = "INSERT INTO news
    			(
    				title,
    				message,
    				page,
    				enabled
    			) 
    			VALUES
    			(
    				?,
    				?,
    				?,
    				1
    			)";

    	//run the sql
        $addnews = $this->db->prepare($sql);
        $addnews->execute
        (
        	array
        	(
	            Request::post('title'),
	            Request::post('message'),
	            Request::post('page')
	        )
	    );
 
        //results
        if($addnews->rowCount()):
        	Session::set('success','added_news');
        else:
        	Session::get('error', 'unknown_error');
        endif;

        Redirect::admin('news');

    }

    public static function admintotaltrades($coin) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT sum(trade_amount) AS total FROM trades 
				WHERE trade_maincoin = ?";
		
		//run the sql
        $totalval = $database->prepare($sql);
        $totalval->execute(array($coin));
        
		//return the results
		return $totalval->fetch();
    }
    
    public static function adminusers() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM users";
		
		//run the sql
        $users = $database->prepare($sql);
        $users->execute();
		
		//return the results
        return $users->fetchAll();
    }
	
    public static function transactions() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM transactions";
		
		//run the sql
        $transaction = $database->prepare($sql);
        $transaction->execute();
		
		//return the results
        return $transaction->fetchAll();
    }

	public static function addcoin()
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "INSERT INTO coins
				(
					coin,
					description,
					title,
					enabled
				) 
				VALUES
				(
					?,
					?,
					?,
					?
				)";
				
		//run the sql
        $addcoin = $database->prepare($sql);
        $addcoin->execute(array($coinname, $cointitle, $coindescription, $enabled));
        
		//
        //$addcol = $this->db->prepare("ALTER TABLE user ADD " . htmlentities($coinname) . " VARCHAR( 25 ) NOT NULL AFTER btc");
        //$addcol->execute();		
	}
	
	
    public static function coinlinks() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM coins";
		
		//run the sql
        $coinmarket = $database->prepare($sql);
        $coinmarket->execute();
        
		//return the results
		return $coinmarket->fetchAll();
    }	
	public static function bannedusers() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM banlist";
		
		//run the sql
        $banlist = $database->prepare($sql);
        $banlist->execute();
        
		//get the results
		return $banlist->fetchAll();
    }
	
	public static function banuser($user, $username, $reason) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
        $sql = "INSERT INTO banlist
				(
					banlist_user,
					banlist_bannedby,
					banlist_banneduntil, 
					banlist_reason,
					banlist_date
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
		$banlist = $database->prepare($database);
        $banlist->execute
        (
        	array
        	(
        		Request::post('user'), 
        		Request::post('banneduntil'), 
        		Request::post('reason'), 
        		date("Y-m-d")
        	)
        );

        //results?
        if($banlist->rowCount()):
        	Session::set('success', 'banned_user');
        else:
        	Session::set('error', 'unknown_error');
       	endif;

       	Redirect::admin('banneduser');
    }
	
	public static function deletenews($id)
	{
		//sql to run
		$sql = "DELETE FROM news 
				WHERE id = ?";

		//run the sql
        $deletenews = $database->prepare($sql);
        $deletenews->execute(array($id));
           
        //results
        //results?
        if($deletenews->rowCount()):
        	Session::set('success', 'deleted_news');
        else:
        	Session::set('error', 'unknown_error');
       	endif;

       	Redirect::admin('news');
	}
	public static function invalidid($user) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "UPDATE users 
				SET user_invalidid = 'invalid' 
				WHERE user_id = ?";
		
		//run the sql
        $invalidid = $database->prepare($sql);
        $invalidid->execute(array($user));
    }

    public static function validid($user) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "UPDATE users 
				SET user_detailverified = 'verified' 
				WHERE user_id";
        
		//run the sql
		$invalidid = $database->prepare($sql);
        $invalidid->execute(array($user));
    }
	
	public static function edituser($id) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM users 
				WHERE user_id = ?";
		
		//run the sql
        $sql = $database->prepare($sql);
        $sql->execute(array($id));
        
		//return the results
		return $sql->fetch();
    }

    public static function pages() 
    {
   		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();

    	//sql to run
    	$sql = "SELECT * FROM pages";

    	//run the sql
        $pages = $database->prepare($sql);
        $pages->execute();
        
        //return the results
        return $pages->fetchAll();
    }


    public static function editcoin($id) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM coins 
				WHERE coin_id = ?";
				
		//run the sq;
        $editcoin = $database->prepare($sql);
        $editcoin->execute(array($id));
        
		//return the results
		return $editcoin->fetch();
    }
	
    public static function news() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM news";
		
		//run the sql
        $news = $database->prepare($sql);
        $news->execute();
        
		//return the results
		return $news->fetchAll();
    }

    public static function editnews($id) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM news 
				WHERE news_id = ?";
		
		//run the sql
        $getnews = $database->prepare($sql);
        $getnews->execute(array($id));
        
		//return the results
		return $getnews->fetch();
    }
	
    public static function updatepage() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "UPDATE pages 	
				SET page_body = ? 
				WHERE page_id = ?";
	
		//run the sql
        $getpage = $database->prepare($sql);
        $getpage->execute(array(Request::post('message'), Request::post('id')));

        //results?
        if($getpage):
        	Alert::success('updated_page');
        else:
        	Alert::error('unknow_error');
        endif;
        
    }

    public static function editpage($id) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT page_body FROM pages 
				WHERE page_id = ?";
		
		//run the sql
        $getpage = $this->db->prepare($sql);
        $getpage->execute(array($id));
        
		//return the results
		return $getpage->fetch();
    }
	
    public static function addpage() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
        //sql to run
		$sql = "INSERT INTO pages
				(
					page_title,
					page_body,
					page_SITE_URL
				) 
				VALUES
				(
					?,
					?,
					?
				)";

		//run the sql
        $addpage = $database->prepare($sql);
        $addpage->execute
        (
        	array
        	(
        		Request::post('title'), 
        		Request::post('message'), 
        		Request::post('url'), 
        		date("Y-m-d")
        	)
        );

        //results?
        if($addpage->rowCount()):
        	Session::set('success', 'added_page');
        else:
        	Session::set('error', 'unknown_error');
       	endif;

       	Redirect::admin('pages');
    }
	
    public static function updatefaq($id, $message) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "UPDATE faq 
				SET faq_faq = ? 
				WHERE faq_id = ?";
		
		//run the sql
        $getfaq = $database->prepare($sql);
        $getfaq->execute(array($message, $id));
        
    }
	
    public static function addfaq($title, $message) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "INSERT INTO faq
				(
					faq_title,
					faq_faq
				) 
				VALUES
				(
					?,
					?
				)";
		
		//run the sql
        $addfaq = $database->prepare($sql);
        $addfaq->execute(array($title, $message, $date));

    }

    public static function editfaq($id) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT faq_faq FROM faq 
				WHERE faq_id=?";
		
		//run the sql
        $getfaq = $database->prepare($sql);
        $getfaq->execute(array($id));
        
		//return the sql
		return $getfaq->fetch();
    }
	
    public static function useridverify() 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM users 
				WHERE user_detailverified = 0 
				AND user_invalidid = 0";
		
		//run the sql
        $users = $database->prepare($sql);
        $users->execute();
        
		//return the results
		return $users->fetchAll();
    }
	
	public static function deletefaq($faq)
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "DELETE FROM faq 
				WHERE faq_id = ?";
		
		//run the sql
		$deletenews = $database->prepare($sql);
        $deletenews->execute(array($id));
		
	}
    public static function updateguide($SITE_URL, $message) 
	{
        if (preg_match('/^[-a-zA-Z ]+$/', $SITE_URL)) {
            $getguide = $this->db->prepare("UPDATE userguides SET message=? WHERE SITE_URL=?");
            $getguide->execute(array($message, $SITE_URL));
            header('LOCATION: ' . ADMINSITE_URL . '/editguide/?SITE_URL=' . $SITE_URL);
        }
    }

	public static function addguide($title, $message, $SITE_URL) {
        if (preg_match('/^[-a-zA-Z ]+$/', $SITE_URL)) {
            $date = strtotime("now");
            $addguide = $this->db->prepare("INSERT INTO userguides(title,message,date,SITE_URL) VALUES(?,?,?,?)");
            $addguide->execute(array(
                $title,
                $message,
                $date,
                $SITE_URL));
            header('location: ' . ADMINSITE_URL . '/guides/');
        } else {
            header('location: ' . ADMINSITE_URL . '/addguide');
        }
    }
}