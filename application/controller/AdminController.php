<?php
namespace Filtration\Controller;

class AdminController extends \Filtration\Core\Controller {

    public function index() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
        $guides = SupportModel::helpguides();
		
		//get total value of trades for each coin
        $totalbtc = AdminModel::admintotaltrades('btc');
        $totalltc = AdminModel::admintotaltrades('ltc');
        $totalusd = AdminModel::admintotaltrades('usd');
        $totalppc = AdminModel::admintotaltrades('ppc');
        $totalnmc = AdminModel::admintotaltrades('nmc');

		//render the pages
		$this->View->RenderPage_admin
		(
			'admin/index', 
			[
			   	'totalbtc' => $totalbtc,
			   	'totalltc' => $totalltc,
			   	'totalusd' => $totalusd,
			   	'totalppc' => $totalppc,
			   	'totalnmc' => $totalnmc
			]
		);
 
    }

    public function users() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get all the users
        $users = AdminModel::adminusers();
		
		$this->View->RenderPage_admin('admin/users', ['users' => $users]);
    }

    public function transactions() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get all the transactions
        $transactions = AdminModel::transactions();
		
		$this->View->RenderPage_admin('admin/transactions', ['transactions' => $transactions]);
    }

    public function coins() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get the coins
        $coin = AdminModel::coinlinks();
		
		$this->View->RenderPage_admin('admin/coins', ['coin' => $coin]);

    }

    public function addcoin() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		$this->View->RenderPage_admin('admin/addcoin');
    }
	
	public function addcoin_action()
	{
		//make sure they're an admin
		AdminModel::auth();
		
        $addcoin = AdminModel::addcoin($coinname, $cointitle, $coindescription, $enabled, $rpc);
	}


    public function editcoin($id = null) 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get the coins info
        $coin = AdminModel::editcoin($id);
		
		$this->View->RenderPage_admin('admin/editcoin', ['coin' => $coin]);
    }

    public function addguide() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
        $this->View->RenderPage_admin('admin/addguide');
    }

    public function settings() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		$this->View->RenderPage_admin('admin/settings');
    }

    public function updatesettings() 
	{
		//make sure they're an admin
		AdminModel::auth();
    }

    public function editguide($SITE_URL = null) 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get the guides info
        $editguide = SupportModel::viewguide($SITE_URL);
        
		$this->View->RenderPage_admin('admin/editguide');
    }

    public function updateguide() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		AdminModel::updateguide();
    }

    public function guides() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
        //get the guides
        $guides = SupportModel::helpguides();
        
		$this->View->RenderPage_admin('admin/guides');
    }

    public function insertguide() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//add the guide
        $addguide = AdminModel::addguide($title, $message, $SITE_URL);
    }

    public function verifyusers() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get unverified users
		$users = AdminModel::useridverify();
		
		$this->View->RenderPage_admin('admin/verifyusers', array('users' => $users));
    }

    public function edituser($user = null) 
	{
 		//make sure they're an admin
		AdminModel::auth();
		
	    //get the user's information
        $edituser = AdminModel::edituser($user);

		$this->View->RenderPage_admin('admin/edituser', array('edituser' => $edituser));
    }

    public function addfaq() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		$this->View->RenderPage_admin('admin/addfaq');
    }

    public function faqs() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
        //get all the faqs
        $faqs = Support::faqs();
        
		$this->View->RenderPage_admin('admin/faqs');
    }

    public function insertfaq() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
        AdminModel::addfaq($title, $message);
    }

    public function editfaq($id = null) 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get the faq
        $editfaq = AdminModel::editfaq($id);
        
		$this->View->RenderPage_admin('admin/editfaq');
    }

    public function deletefaq($faq = null) 
	{
		//make sure they're an admin
		AdminModel::auth();
		
        AdminModel::deletefaq($faq);
    }

    public function updatefaq() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		$updatefaq = AdminModel::updatefaq($id, $message);
    }

    //add, view and edit pages
    public function addpage() 
	{
		//make sure they're an admin
		AdminModel::auth();		

        $this->View->RenderPage_admin('admin/addpage');
    }


    public function banneduser() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get the banned users
        $bannedusers = AdminModel::bannedusers();
        
		$this->View->RenderPage_admin('admin/bannedusers', array('bannedusers' => $bannedusers));
    }



    public function addnews() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		$this->View->RenderPage_admin('admin/addnews');
    }


    public function news() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
        //get all the news articles
		$news = AdminModel::news();
 
		$this->View->RenderPage_admin('admin/news', array('news' => $news));
    }

	public function editpage($id = null) 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get the page's info
        $editpage = AdmimModel::editpage($id);
        
		$this->View->RenderPage_admin('admin/editpage', array('editpage' => $editpage));
    }
	
    public function editnews($id = null) 
	{
		//make sure they're an admin
		AdminModel::auth();
		
        //get the news article
        $editnews = AdminModel::editnews($id);
        
		$this->View->RenderPage_admin('admin/editnews', array('editnews' => $editnews));
    }
	
    public function pages() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		//get the pages
        $pages = AdminModel::pages();
        
		$this->View->RenderPage_admin('admin/pages', array('pages' => $pages));
    }
	
    public function modcp() 
	{
		//make sure they're an admin
		AdminModel::auth();
		
		$this->View->RenderPage_mod('admin/modcp');
    }
	
	
	
    public function deletenews($id = null) 
    {
        //make sure they're an admin
        AdminModel::auth();

        AdminModel::deletenews($id);
    }

	public function insertnews() 
    {
        //make sure they're an admin
        AdminModel::auth();
        
        AdminModel::addnews();
    }
	
    public function banuser() 
	{
        //make sure they're an admin
        AdminModel::auth();

	   AdminModel::banuser();
    }

    public function unban($user = null) 
	{
        //make sure they're an admin
        AdminModel::auth();

        AdminModel::unban($user);
    }
	


    public function insertpage() 
    {
        //make sure they're an admin
        AdminModel::auth();

        AdminModel::add_page();
    }



    public function updatepage() 
    {
        //make sure they're an admin
        AdminModel::auth();

        AdminModel::update_page();
    }

    public function invalidid() 
    {
        SESSION_START();
        if (!$this->model->isadmin() == true) {
            header('location: ' . SITE_URL . '/index');
        }
        $user = isset($_GET['user']) ? $_GET['user'] : '';
        if (!$user == null) {
            $invalidid = $this->model->invalidid($user);
            header('location: ' . ADMINSITE_URL . '/edituser/?id=' . $user);
        }
    }

        public function deletecoin() {
        SESSION_START();
        if (!$this->model->isadmin() == true) {
            header('location: ' . SITE_URL . '/index');
        }
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $coinname = isset($_GET['coin']) ? $_GET['coin'] : '';
        if (isset($id)):
            $deletecoin = $this->db->prepare("DELETE FROM coins WHERE id=?");
            $deletecoin->execute(array($id));
            $deletecol = $this->db->prepare("ALTER TABLE user DROP COLUMN " . htmlentities($coinname) . "");
            $deletecol->execute();
            header('location: ' . ADMINSITE_URL . '/coins');
        endif;
    }

    public function validid() {
        SESSION_START();
        if (!$this->model->isadmin() == true) {
            header('location: ' . SITE_URL . '/index');
        }
        $user = isset($_GET['user']) ? $_GET['user'] : '';

        if (!$user == null) {
            $validid = $this->model->validid($user);
            header('location: ' . ADMINSITE_URL . '/edituser/?id=' . $user);
        }
    }

    public function getuserimg() 
	{
		
        $img = isset($_GET['img']) ? htmlspecialchars($_GET['img'], ENT_QUOTES) : '';
        $user = isset($_GET['user']) ? $_GET['user'] : '';
        if (file_exists($img) && !empty($img)) {
            $imginfo = getimagesize($img);
            header("Content-type: " . $imginfo['mime']);
            echo readfile($img);
        }
        header("Content-type: image/jpeg");
        echo readfile($img);
    }
}

?>