<?php
namespace Filtration\Controller;
/* fix harcoded json results kek */

use Filtration\Model\UserModel;
use Filtration\Model\CoinsModel;
use Filtration\Model\OrdersModel;
use Filtration\Model\TradesModel;
use Filtration\Model\PaymentModel;

class DashboardController extends \Filtration\Core\Controller {

    public function index() 
	{
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();

        //Use the function which checks what market the user is on to include the ticker
        $coin = isset($_GET['market']) ? strtoupper($_GET['market']) : 'BTC_USD';
        
        if (CoinsModel::coins($coin) == false):
            $coin = 'BTC_USD';
        endif;

        //get the coin
        $coin2 = explode('_', $coin);

        //Get the data from tables orders and trades
        $buyOrder = OrdersModel::OrderDashboard($coin, 'buy');
        $sellOrder = OrdersModel::OrderDashboard($coin, 'sell');
        $trade = TradesModel::TradesDashboard($coin);

        //PaymentModel::buy_coins();
        
        //$this->model->DashboardTicker($coin);

        $this->View->RenderMulti
        (
            [   
                '_templates/header',
                '_templates/navigation',
                'dashboard/index', 
                '_templates/footer'
            ],
            [
                'buyorder' => $buyOrder,
                'sellorder' => $sellOrder,
                'trade' => $trade,
                'coin2' => $coin2,
                'coin' => $coin,
                'user' => $user
            ]
        );
    }

    public function trade_coin($coin = null)
    {
        //make sure they're logged in
        UserModel::authentication();

        PaymentModel::buy_coins($coin);
    }

    public function verify() 
	{		
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();
		
        $this->View->RenderPage_sidebar('verify/verify');
    }

    public function orders() 
	{
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();
		
        //get the user's orders 
        $buyorders = TradesModel::OpenOrders('buy');
        $sellorders = TradesModel::OpenOrders('sell');
        
		$this->View->RenderPage_sidebar('dashboard/orders', ['buyorders' => $buyorders, 'sellorders' => $sellorders]);
    }

    
    public function trades() 
	{
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();
		
        $trades = TradesModel::CompletedOrders();
		
        $this->View->Render('dashboard/trades', ['trades' => $trades]);
    }

    public function invoice($id = null) 
	{
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();
        
		//get the user's invoice
		$invoice = InvoiceModel::invoice($id);

		$this->View->Render('dashboard/invoice', ['invoice' => $invoice, 'user' => $user]);
    }

    public function deposit() 
	{

		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();
		
        //initiate the wallets; going to find a better way to do it
        $deposit = PaymentModel::depositcoin();
        
		//$btcdeposit = $this->model->btcwallet($user->username,'');
        
        $this->View->Render('dashboard/deposit', ['deposit' => $deposit, 'user' => $user]);
    }

    public function deleteorders($id, $order) 
	{
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();
		
		OrderModel::manage_order($id, $order);
    }

    public function chartdata($coin = null) 
	{
        header('Content-type: application/json'); //change to json whenever 
		
        $result = ChartModel::chartdata($coin);
        
		// Print out rows
        foreach ($result as $row) {
            $results[] = array
            (
                "date" => System::escape($row->trade_date),
                "value1" => System::escape($row->price),
                "value2" => System::escape($row->amount)
            );
        }

        echo json_encode($results);
    }

    public function buycoin() 
	{
  
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();
		
		PaymentModel::buy_coin($id, $order);
    }

    public function dashboardtrades($coin = null) 
	{

        header('Content-type: text/plain');

        $result = TradesModel::TradesDashboard($coin);

        // Print out rows
        echo "{";
        echo " \"data\": [";
        foreach ($result as $row) {
            echo $prefix . "[";
            echo '"' . $row->amount . '",';
            echo '"' . $row->market . '",';
            echo '"' . $row->cost . '",';
            echo '"' . $row->time . '",';
            echo '"' . $row->user . '",';
            echo '"' . $row->buysell . '"';
            echo "]";
            $prefix = ", ";
        }
        echo "]}";
    }

    public function dashboardprice($coin = 'BTC_USD', $type = null) 
	{
		//make sure they're logged in
		UserModel::authentication();
		
        //get the market
        $coin2 = explode('_', $coin);

        //get the price ticker
        if (file_exists(\Filtration\Core\Config::get('PATH_LIBS')."tickers/" . strtolower($coin2[0]) . ".php")):
            include (\Filtration\Core\Config::get('PATH_LIBS')."tickers/" . strtolower($coin2[0]) . ".php");
        endif;

        //case to get buy or sell
        switch ($type) {
            case 'buy':
                echo $coinTicker->price($coin2[1], 'buy');
                break;
            case 'sell':
                echo $coinTicker->price($coin2[1], 'sell');
                break;
        }
    }

    public function transactions() 
	{
  
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();
		
		//get the users transaction
        $transactions = OrdersModel::transactions();
        
		$this->View->Render('dashboard/transactions', ['transactions' => $transactions]);
    }

    public function openorders($coin = null, $type = null)
	{
          
		//make sure they're logged in
		UserModel::authentication();
		
        //get the session user
        $user = UserModel::user();

		//types of orders
        switch ($type) {
            case 'buy':
                $order = OrdersModel::OrderDashboard($coin, 'buy');
                break;
            case 'sell':
                $order = OrdersModel::OrderDashboard($coin, 'sell');
            break;
        }
		
        //Get the data from tables orders and trades
        foreach ($order as $orders) 
        {
            $result[] = array
            (
                'price' => number_format($orders->order_price, 2),
                'amount' => number_format($orders->order_amount, 6),
                'cost' => number_format($orders->order_cost, 2)
            );
        }
		
        echo json_encode($result);
    }

    public function myorders($coin) 
	{
 		//make sure they're logged in
		UserModel::authentication();

		//get user's orders
        $order = OrdersModel::myorders($coin);

        //Get the data from tables orders and trades
        $result = array();
        
		foreach ($order as $Orders) {
            array_push($result, array('id' => $Orders->order_id,
                'amount' => number_format($Orders->order_amount, 6),
                'cost' => number_format($Orders->order_cost, 6),
                'price' => number_format($Orders->order_price, 2),
                'time' => $Orders->order_time,
                'buysell' => $Orders->order_buysell));
        }
		
        echo json_encode(array("result" => $result));
    }



}
