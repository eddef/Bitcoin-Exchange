<?php

class PagesController extends Controller {

    public function page($id = null) 
	{
		//get the page
        $page = PagesModel::viewpage($id);
		
		//make sure page exists
		if(empty($page)): Redirect::to('home/index'); endif;
		
		$this->View->RenderPage('pages/index', array('page' => $page));
    }

}
