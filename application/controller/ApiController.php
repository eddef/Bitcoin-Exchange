<?php
namespace Filtration\Controller;

use Filtration\Model\UserModel;
use Filtration\Model\ApiModel;
use Filtration\Core\FormValidation;
use Filtration\Core\Alert;
use Filtration\Core\Request;

class ApiController extends \Filtration\Core\Controller 
{

    public function api() 
    {
        //make sure they're logged in
        UserModel::authentication();
        
        //user's apis
        $apis = ApiModel::getapi();
        
        $this->View->RenderMulti
        (
            [
                '_templates/header',
                '_templates/navigation',
                'user/api'
            ], 
            [   
                'apis' => $apis
            ]
        );
    }

    public function deleteapi($api = null) 
    {
        //make sure they're logged in
        UserModel::authentication();
        
        ApiModel::delete_api($api);
        
    }

    public function generateapi() 
    {
        //make sure they're logged in
        UserModel::authentication();

        // Let's define the rules and filters
        $rules = array(
            'name'    => 'required',
        );
            
        
        //validate the info
        $validated = FormValidation::is_valid($_POST, $rules);
        
        // Check if validation was successful
        if($validated !== TRUE):    
                                   
            //exit with an error
            exit(Alert::error(false, true, $validated));

        endif;

        ApiModel::createapi();
    }

    public function index() 
    {
        $this->View->Render('api/index');
    }

    public function ticker() 
    {
        header('Content-Type: application/json');
        
        $market     = isset($_GET['ticker']) ? strtoupper(htmlspecialchars($_GET['ticker'], ENT_QUOTES)) : '';
        $tickerHigh = ApiModel::ticker("trade_price", $market, "buy", " ORDER BY trade_price DESC");
        $tickerLOW  = ApiModel::ticker("trade_price", $market, "buy", " ORDER BY trade_price ASC");
        $tickerAVG  = ApiModel::ticker("avg(trade_price)", $market, "buy", "");
        $tickerLAST = ApiModel::ticker("trade_price", $market, "buy", " ORDER BY trade_date DESC");
        $tickerVOL  = ApiModel::ticker('sum(trade_amount)', $market, '', '');
        $tickerBuy  = ApiModel::ticker("avg(trade_price)", $market, "buy", "AND trade_date > DATE_SUB(NOW(), INTERVAL 1 DAY)");
        $tickerSell = ApiModel::ticker("avg(trade_price)", $market, "sell", "AND trade_date > DATE_SUB(NOW(), INTERVAL 1 DAY)");

        //$ticker = ApiModell::ticker($market);
        $result = array();
        if (CoinsModel::coins($market) == false):
            array_push($result, array('error' => 'invalid market'));
            echo json_encode(array("ticker" => $result));
            die();
        endif;
        
        //get the ticker information
        array_push($result, array('market' => $market,
            'high' => round($tickerHigh, 4),
            'low' => round($tickerLOW, 4),
            'avg' => round($tickerAVG, 4),
            'last' => round($tickerLAST, 4),
            'vol' => round($tickerVOL, 4),
            'buy' => round($tickerBuy, 4),
            'sell' => round($tickerSell, 4),
            'server_time' => strtotime('now')
        ));
        
        //return the results
        echo json_encode(array("ticker" => $result));
    }

    public function orders() 
    {
        header('Content-Type: application/json');
        
        $data = isset($_GET['data']) ? $_GET['data'] : '';
        $data = json_decode(stripslashes($data), TRUE);
        
        $message = $data['data'];
        $result = array();
        
        //check if their API information is correct
        if (ApiModel::checkapi($data, $message) == false):
            array_push($result, array('success' => false,
                'error' => 'invalid api'));
            echo json_encode(array("result" => $result));
        endif;
        
        //okay it's a success
        if ($message == 1):
            $orders = $this->db->prepare("SELECT * FROM orders WHERE user=?");
            $orders->execute(array(ApiModel::checkapi($data, $message)));
            $openorder = $orders->fetchAll();
            foreach ($openorder as $openorders):
                array_push($result, array('id' => $openorders->id,
                    'market' => $openorders->market,
                    'amount' => $openorders->amount,
                    'cost' => $openorders->cost,
                    'price' => $openorders->price,
                    'buysell' => $openorders->buysell,
                    'beforefee' => $openorders->beforefee));
            endforeach;
        
        endif;
        
        //return the results
        echo json_encode(array("orders" => $result));
    }

  

    public function transactions() 
	{
       
        if (ApiModell::checkapi($data, $message) == false):
            array_push($result, array('success' => false,
                'error' => 'invalid api'));
            echo json_encode(array("result" => $result));
            die();
        endif;
        if ($message == 1):
            $transactions = $this->db->prepare("SELECT * FROM transactions WHERE username=?");
            $transactions->execute(array(ApiModell::checkapi($data, $message)));
            $transaction = $transactions->fetchAll();
            foreach ($transaction as $alltransactions):
                array_push($result, array('address' => $alltransactions->address,
                    'txid' => $alltransactions->txid,
                    'amount' => $alltransactions->amount,
                    'type' => $alltransactions->transaction,
                    'time' => $alltransactions->time));
            endforeach;
        endif;
        echo json_encode(array("transactions" => $result));
    }

}

?>