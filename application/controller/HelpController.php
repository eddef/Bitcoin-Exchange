<?php
namespace Filtration\Controller;

use Filtration\Model\SupportModel;

class HelpController extends \Filtration\Core\Controller 
{

    public function index() 
	{
		//get the site's guides
        $guides = SupportModel::helpguides();

		$this->View->Render('help/guide', array('guides' => $guides));
    }

    public function faq() 
	{
		//get the site's faqs
		$faqs = SupportModel::faqs();
		
		$this->View->Render('help/faq', array('faqs' => $faqs));
    }

    public function tickets() 
	{
		$this->View-->Render('home/tickets');
    }

    public function tos() 
	{
		$this->View->Render('help/tos');
    }

    public function guide($id = null) 
	{
        //get the guides
		$guide = SupportModel::viewguide($id);
		
        // make sure a guide exisrs
        if(!empty($guide)){
		  $this->View->RenderMulti(['help/viewguides'], ['guide' => $guide]);
        }
        
    }

    public function viewguides($guide) 
	{
        //view the guide
        $viewguide = SupportModel::viewguide($guide);
        
		$this->View->Render('help/viewguides');
    }

    public function mobile() 
	{
        $this->View->RenderPage('help/mobile');
    }

    public function contact() 
	{
        $this->View->Render('help/contact');
    }

}
