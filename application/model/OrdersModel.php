<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;
use Filtration\Core\Session;

Class OrdersModel
{
    public static function OrderDashboard($coin, $type) 
	{
		
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
        $sql = "SELECT order_id, 
        			   order_amount, 
        			   order_market, 
        			   order_cost, 
        			   order_price 
        		FROM orders 
				WHERE order_market = ? 
				AND order_user != ? 
				AND order_buysell = ? ";
        
		//run the sql
		$query = $database->prepare($sql);
        $query->execute(array($coin, Session::get('user_id'), $type));
        
		//return the results
		return $query->fetchAll();
    }

	public static function my_open_orders($order)
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM orders 
				WHERE order_user = ? 
				AND order_buysell = ?";

        //check open orders
        $openorders = $database->prepare($sql);
        $openorders->execute(array(Session::get('user_id'), $order));

        //return the results
        return $openorders->fetchAll();
	}

    public static function userownsorder($id, $buysell) 
	{
		
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT count(*) FROM orders 
				WHERE order_id = ? 
				AND order_user = ? 
				AND order_buysell = 'buy'";
        
		//run the sql
		$checkfield = $database->prepare($sql);
        $checkfield->execute(array($id, Session::get('user_id')));
        
		//return the results
		return $checkfield->fetchColumn();

        
    }
	
	public static function transactions() 
	{
		
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM transactions 
				WHERE transaction_user = ? 
				ORDER BY transaction_date DESC";
				
		//run the sql
        $transaction = $database->prepare($sql);
        $transaction->execute(array(Session::get('user_id')));
        
		//return the data
		return $transaction->fetchAll();
    }
	
    public static function myorders($coin) 
	{
		
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM orders 
				WHERE order_market = ? 
				AND order_user = ?";
				
		//run the sql
        $query = $database->prepare($sql);
        $query->execute(array($coin, Session::get('user_id')));
        
		//return the results
		return $query->fetchAll();
    }
	
    public static function openhomeorders($market, $buysell) 
	{
		
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "SELECT * FROM orders 
				WHERE order_market = ? 
				AND order_buysell = ?";
				
		//run the sql
        $orders = $database->prepare($sql);
        $orders->execute(array($market, $buysell));
        
		//return the results
		return $orders->fetchAll();
    }
	
	public static function homeorders($type) 
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
        switch ($type) {
            case 'homebuy':
                $homebuy = $database->prepare("SELECT * FROM orders WHERE order_buysell='buy' ORDER BY order_time DESC LIMIT 5");
                $homebuy->execute();
                return $homebuy->fetchAll();
                break;
            case 'homesell':
                $homesell = $database->prepare("SELECT * FROM orders WHERE order_buysell='sell' ORDER BY order_time DESC LIMIT 5");
                $homesell->execute();
                return $homesell->fetchAll();
                break;
            case 'hometrade':
                $hometrade = $database->prepare("SELECT * FROM trades ORDER BY trade_time DESC LIMIT 5");
                $hometrade->execute();
                return $hometrade->fetchAll();
                break;
        }
    }

	
	public static function manage_order($id, $order)
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "DELETE FROM orders 
				WHERE order_id = ? 
				AND order_buysell = ?
				AND order_user = ?";
		
		//run the sql
		$deleteorder = $database->prepare($sql);
        $deleteorder->execute(array($id, $order, Session::get('user_id')));
		
		//the results?
		if($deleteorder->rowCount()):
		
		else:
		
		endif;
	}

	public static function delete_order($database, $id, $order)
	{
		//iniate the database-
		$database = DatabaseFactory::getFactory()->getConnection();
		
		//sql to run
		$sql = "DELETE FROM orders 
				WHERE id = ? 
				AND buysell = ?";
		
		//run the sql
		$deleteorder = $database->prepare($sql);
        $deleteorder->execute(array($id, $order));
	}

	public static function order_price($database, $coinvalue, $order)
	{
        //sql to run
        $sql = "SELECT * FROM orders 
                WHERE order_price = ? 
                AND order_buysell = ? 
                AND order_user != ?";

        //run the sql
        $sellingorder = $database->prepare($sql);
        $sellingorder->execute(array($coinvalue, $order, Session::get('user_id')));
        
        //return the sql
        return $sellingorder->fetch();		
	}

	public static function update_order($database, $nowowned, $id, $order)
	{
		//sql to run
		$sql = "UPDATE orders 
				SET order_amount = ? 
				WHERE order_id = ? 
				AND order_buysell = ?";

		//run the sql
		$updatetotal = database($sql);
        $updatetotal->execute(array($nowowned, $id, $order));
	}
}