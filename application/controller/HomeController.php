<?php
namespace Filtration\Controller;

use Filtration\Model\OrdersModel;
use Filtration\Model\TradesModel;
use Filtration\Model\ChartModel;

class HomeController extends \Filtration\Core\Controller {

    public function index($market = 'btc_usd') 
	{
		$this->View->Render('home/index', array('market' => $market));
    }

    public function liveorders() 
	{
		
		//get the orders
        $buymarket = OrdersModel::homeorders('homebuy');
        $sellmarket = OrdersModel::homeorders('homesell');
        $trademarket = OrdersModel::homeorders('hometrade');
       
		$this->View->RenderMulti
        (
            array('home/liveorders'), array
            (
                'buymarket' => $buymarket, 
				'sellmarket' => $sellmarket,
				'trademarket' => $trademarket
            )
        );
    }
	

    public function order_book($market = 'btc_usd') 
	{
		//get orders and trades
        $buyorders = OrdersModel::openhomeorders($market, 'buy');
        $sellorders = OrdersModel::openhomeorders($market, 'sell');
        $trades = TradesModel::TradesDashboard($market);

		$this->View->RenderPage_sidebar
        (
            'home/order_book', array
            (
                'buyorders' => $buyorders,
			    'sellorders' => $sellorders,
			    'trades' => $trades
            )
        );
    }

    public function datacharts($market = 'btc_usd') 
	{
        // get the data for the charts
        $chartdata = ChartModel::home($market);

        // run through the data to make a json file
        $result = array();
        foreach ($chartdata as $data) {

            array_push($result, 
                    array(strtotime($data->trade_date) * 1000,
                          $data->trade_amount,
                          number_format($data->trade_total, 4)
                        )
                    );
        }

        print json_encode($result, JSON_NUMERIC_CHECK);
    }

    /*
     * Will remove this method and re-write it. Added
     * to: todo.txt
     */
    public function language() 
	{
        $language = isset($_GET['id']) ? $_GET['id'] : '';
        if (!empty($language)):
            //also probably add to user account but just set cookie ftb
            setcookie("locale", $language, time() + 3600 * 24 * 365 * 10, '/');
            header('LOCATION: ./');
        endif;
    }


}
