<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
use Filtration\Core\Session;

Class TradesModel
{
	
    public static function TradesDashboard($coin) 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
        $sql = "SELECT * FROM trades 
				WHERE trade_market = ?";
        
		//run the sql
		$query = $database->prepare($sql);
        $query->execute(array(strtolower($coin)));
        
		//return the results
		return $query->fetchAll();
    }
	
	public static function OpenOrders($type) 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
		$sql = "SELECT * FROM orders 
				WHERE order_user = ? 
				AND order_buysell = ?";
		
		//run the sql
        $getorder = $database->prepare($sql);
        $getorder->execute(array(Session::get('user_id'), $type));
        
		//return the query
		return $getorder->fetchAll();
    }
	
    public static function CompletedOrders() 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
		$sql = "SELECT * FROM trades 
				WHERE trade_user = ?";
				
		//run the sql
        $getorder = $database->prepare($sql);
        $getorder->execute(array(Session::get('user_id')));
        
		//return the results
		return $getorder->fetchAll();
    }
	
	public static function add_trade($totalwithfee, $coin, $totalprice, $userip, $coinvalue, $order, $currencynotifi, $amount)
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 

		//sql to run
		$sql = "INSERT INTO orders
				(
					order_amount,
					order_market,
					order_cost,
					order_time,
					order_user,
					order_ip,
					order_price,
					order_buysell,
					order_maincoin,
					order_beforefee,
					order_fee
				)
				VALUES
				(
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?
				)";

		//run the sql
        $tradehistory = $database->prepare($sql);
        $tradehistory->execute
        (
        	array
        	(
        		$totalwithfee, 
        		$coin, 
        		$totalprice, 
        		date("y-m-d h:i:s"),
            	Session::get('user_id'), 
            	$userip, 
            	$coinvalue, 
            	$order, 
            	$currencynotifi, 
            	$amount, 
            	TRANSACTION_FEES
            )
        );		
	}

	public static function add_transaction($database, $totalwithfee, $coin, $totalprice, $userip, $coinvalue, $order, 
			$currencynotifi, $user)
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 

		//sql to run
		$sql = "INSERT INTO trades
				(
					trade_amount,
					trade_market,
					trade_cost,
					trade_time,
					trade_user,
					trade_ip,
					trade_price,
					trade_buysell,
					trade_date,
					trade_maincoin,
					trade_fee,
					trade_charttime
				) 
				VALUES
				(
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?
				)";
        
        //run the sql
        $tradehistory = $database->prepare($sql);
        $tradehistory->execute
        (
        	array
        	(
        		$totalwithfee, 
        		$coin, 
        		$totalprice, 
        		date("y-m-d h:i:s"),
            	$user, 
            	$userip, 
            	$coinvalue, 
            	$order, 
            	date("Y-m-d h:i:s"), 
            	$currencynotifi, 
            	SITE_FEES, 
            	strtotime("now")
            )
        );	
	}
}