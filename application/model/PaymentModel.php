<?php
namespace Filtration\Model;

use Filtration\Core\DatabaseFactory;

Class PaymentModel
{
	public static function depositcoin() 
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
		$sql = "SELECT * FROM coins 
				WHERE coin_enabled = 'enabled'";
				
		//run sql 
        $depositcoin = $database->prepare($sql);
        $depositcoin->execute();
        
		//return the results
		return $depositcoin->fetchAll();
    }
	
	public static function buy_coins($coin = null)
	{
        //iniate session user
        $username = UserModel::user();
		
        //currency they want to use
        $currency0 =  isset($coin) ? explode('_', $coin) :  explode('_', 'btc_usd');

        //do they want to buy or sell coins?
        $buysell = (Request::post('buysell') == true) ? System::escape(Request::post('buysell')) : '';

        //currency... i.e bitcoin and usd or usd and bitcoin
        $currencynotifi = strtolower($currency0[0]);
        $currencynotifi1 = strtolower($currency0[1]);

        //edit certain varibles
        switch ($buysell) {
            case 'buy':
                $currency = strtolower($currency0[0]);
                $currency1 = strtolower($currency0[1]);
                $order = 'buy';
                $order1 = 'sell';
            break;
            case 'sell':
                $currency = strtolower($currency0[1]);
                $currency1 = strtolower($currency0[0]);
                $order = 'sell';
                $order1 = 'buy';
            break;
        }

        //get the price ticker
        if (file_exists(Config::get('PATH_LIBS')."tickers/" . strtolower($currency0[0]) . ".php")):
            include (Config::get('PATH_LIBS')."tickers/" . strtolower($currency0[0]) . ".php");
        endif;

        //amount they're buying/selling
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '0';

        //value of the coin
        $coinvalue = isset($_POST['price']) ? $_POST['price'] : $coinTicker->price(strtoupper($currency0[1]), $order);

        $minvalue = $coinTicker->price(strtoupper($currency0[1]), $order) - ($coinTicker->price(strtoupper($currency0[1]), $order) * 0.1);


        //
        if ($coinvalue < $minvalue):echo Filtration\Core\System::translate("Price is too low. Minimum price: ");
            echo $minvalue;
            die();
        endif;
        //lowest amount possible 
        if ($amount < 0.001): echo Filtration\Core\System::translate("Order is too low. Minimum order is 0.002");
            die();
        endif;
        //make sure they're actually using numbers
        if (!is_numeric($coinvalue)): echo Filtration\Core\System::translate("Numbers only, please!");
            die();
        endif;
        if (!is_numeric($amount)): echo Filtration\Core\System::translate("Numbers only, please!");
            die();
        endif;

        //get the users orders
        $my_orders = OrdersModel::my_open_orders($order);

        //set total price as 0 to loop through all open orders
        $total_price = 0;
        $total_coins = 0;
        foreach($my_orders as $my_order) 
        {
            //add up all of their orders to check total orders
            $total_coins += $my_order->order_beforefee;
            $total_price += $my_order->order_cost;
            //echo $total_coins;
        }


        //check if they have enough
        switch ($buysell) {
            case 'buy':
                //could put these in an || to free up some space, but need to free up model first
                if ($total_price + ($amount * $coinvalue) > $username->{"user_".$currency1}):
                    echo Filtration\Core\System::translate("You do not have enough to put in the orders");
                    die();
                endif;

                if ($username->{"user_".$currency1} < 0):
                    echo Filtration\Core\System::translate("Negative balance. System has been notified.");
                    die();
                endif;

                if ($username->{"user_".$currency1} < ($amount * $coinvalue)):
                    echo Filtration\Core\System::translate("You do not have enough to put in the order");
                    die();
                endif;

            break;
            case 'sell':
                //make sure they have enough to put in the order
                if ($username->{"user_".$currency1} < ($total_coins + $amount)):
                    echo Filtration\Core\System::translate("You do not have enough to put in the order");
                    die();
                endif;
                if ($username->{"user_".$currency1} < 0):
                    echo Filtration\Core\System::translate("Negative balance. System has been notified.");
                    die();
                endif;
                if ($username->{"user_".$currency1} < $amount):
                    echo Filtration\Core\System::translate("You do not have enough to put in the order");
                    die();
                endif;
            break;
        }

        //users IP.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARTDED_FOR'] != '')
        {
            $userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } 
        else
        {
            $userip = $_SERVER['REMOTE_ADDR'];
        }
        

        //just create a variable, could probably use $amount but w/e
        $total = $amount;

        //get the total value of the coin depending on the price
        $totalprice = ($amount * $coinvalue);

        //total price of coin added to the user balance
        $total1 = ($amount * $coinvalue) + $username->{"user_".$currency1};

        // Let's define the rules and filters
        $rules = array(
            'amount'    => 'min_numeric,0.02',
        );
            
        
        //validate the info
        $validated = FormValidation::is_valid($_POST, $rules);
        
        // Check if validation was successful
        if($validated !== TRUE):    
                                   
            //exit with an error
            exit($validated);

        endif;

        //get the amount they are wanting to buy/sell round to 4 decimals
        $amount = Request::post('amount');

        //if user hasn't set price value use default value from ticker
        $coinvalue = (Request::post('price') == true) ? Request::post('price') : $coinTicker->price(strtoupper
                                ($currency), $order);

        //get the user's balance whatever the market
        
        $balance = $username;

        //total minus our fees
        $totalwithfee = ($total) * (1 - TRANSACTION_FEES);
        $totalwithfee1 = ($total1) * (1 - TRANSACTION_FEES);

        //double check 
        if (CoinsModel::coin_exists(strtoupper($coin)) == false):
            echo Filtration\Core\System::translate("Market does not exist");
            die();
        endif;


        $totalwithfee = ($amount) * (1 - TRANSACTION_FEES);


        //check to see if a selling order exists to buy, if not, we'll add one
        //in the orders database
        
        //iniate the database and the transaction
        $database = DatabaseFactory::getFactory()->getConnection(); 
        $database->beginTransaction();


        ///okay an order exists
        if (OrdersModel::order_price($database, $coinvalue, $order1)) 
        {
             
            //remove the wanting to buy from the amount the 3rd party is selling   
            $nowowned = OrdersModel::order_price($database, $coinvalue, $order1)->order_amount - $amount;
            
            if ($checksell->amount >= $amount) 
            {
                //person who already put in the order -- not you (the session guy)
                $buyuserbalance = $buyuser->fetch();

                //buy or sell
                if($buysell == 'buy')
                {
                    //their new total
                    $newtotal = float($checksell->order_price * $amount);
                    
                    //other person
                    $buyersmoney = float($buyuserbalance->{"user_".$currency1} + $newtotal);
                    $buyersbalance = float($buyuserbalance->{"user_".$currency}) - $amount * (1 - SITE_FEES);
                    
                    //now update the sellers amount/balance
                    $newbalance = float($username->{"user_".$currency1} - $newtotal);
                    $sellersnewbalance = float($username->{"user_".$currency} + $amount);
                    
                    //check their wanting to buy coin amount and add owned coins
                    $ownedcoins = float($totalwithfee + $username->{"user_".$currency1});
                }
                elseif($buysell == 'sell')
                {
                    //thier new total
                    $newtotal = float($checksell->order_price * $amount);
                    
                    //other person
                    $buyersmoney = float($buyuserbalance->{"user_".$currency1} + $amount) * (1 - SITE_FEES);
                    
                    echo $buyersmoney;
                    
                    $buyersbalance = float($buyuserbalance->{"user_".$currency}) - $newtotal;
                    
                    //now update the sellers amount/balance
                    $newbalance = float($username->{"user_".$currency1}) - $amount;
                    $sellersnewbalance = float($username->{"user_".$currency}) + $newtotal;
                    
                    //check their wanting to buy coin amount and add owned coins
                    $ownedcoins = $totalwithfee + float($username->{"user_".$currency});
                }

                //check if there's a buy order in 
                if ($nowowned <= 0) 
                {
                    //update trades and the user acc
                    OrdersModel::delete_order($database, $checksell->order_id, $order1);

                    //update buy/sellers balance
                    UserModel::update_balance($database, $buyersbalance, $buyersmoney, $checksell->order_user);

                    //update session users balance
                    UserModel::update_balance($database, $sellersnewbalance, $newbalance, Session::get('user_id'));

                    //add notification for buyer
                    TradesModel::add_transaction($database, $totalwithfee, $coin, $totalprice, $userip, $coinvalue, $order, $currencynotifi, $user);

                    //add notification for seller
                    TradesModel::add_transaction($totalwithfee, $coin, $totalprice, $userip, $coinvalue, $order, $currencynotifi,$checksell->order_user);
                } 
                else 
                {
                    //Update the order table to remove the amount the user bought
                    OrdersModel::update_order($nowowned, $checksell->order_id, $order1);

                    //there balance now
                    $nowowned = $checksell->order_amount - $amount;

                    //update buy/sellers balance
                    UserModel::update_balance($buyersbalance, $buyersmoney, $checksell->order_user);

                    //update session users balance
                    UserModel::update_balance($sellersnewbalance, $newbalance, Session::get('user_id'));

                    //add notification for buyer
                    TradesModel::add_transaction($totalwithfee, $coin, $totalprice, $userip, $coinvalue, $order, $currencynotifi, $user);

                    //add notification for seller
                    TradesModel::add_transaction($totalwithfee, $coin, $totalprice, $userip, $coinvalue, $order, $currencynotifi,$checksell->order_user);
                }
            }
        } else {

            TradesModel::add_trade($totalwithfee, $coin, $totalprice, $userip, $coinvalue, $order, $currencynotifi, $amount);
        }	

        $database->commit();
        
        //notify them that they've put in an order
        echo 'You have put a ' . System::escape($order) . ' order in with a total of ' . System::escape($amount) . ' ' . strtoupper(System::escape($currencynotifi)) .
        ' ' . ' worth ' . System::escape($totalprice) . ' ' . strtoupper(System::escape($currencynotifi1)) .
        ' and you will receive ' . System::escape($totalwithfee) . ' ' . strtoupper(System::escape($currencynotifi));
	
		
	}
	
}