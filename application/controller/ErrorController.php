<?php
namespace Filtration\Controller;

class ErrorController extends \Filtration\Core\Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function error404()
    {
        header('HTTP/1.0 404 Not Found', true, 404);
        $this->View->render('error/index');
    }
}
