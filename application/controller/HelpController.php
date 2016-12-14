<?php

class HelpController extends Controller 
{

    public function index() 
	{
		//get the site's guides
        $guides = SupportModel::helpguides();
		
		$this->View->RenderPage_sidebar('help/guide', array('guides' => $guides));
    }

    public function faq() 
	{
		//get the site's faqs
		$faqs = SupportModel::faqs();
		
		$this->View->RenderPage_sidebar('help/faq', array('faqs' => $faqs));
    }

    public function tickets() 
	{
		$this->View-->RenderPage_sidebar('home/tickets');
    }

    public function tos() 
	{
		$this->View->RenderPage_sidebar('help/tos');
    }

    public function guide() 
	{
        //get the guides
		$guides = SupportModel::helpguides();
		
		$this->View->RenderPage_sidebar('help/guide');
        
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
        $this->View->RenderPage_sidebar('help/contact');
    }

}
