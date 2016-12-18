<?php
namespace Filtration\Controller;

use Filtration\Model\CoinsModel;
use Filtration\Model\TransferModel;
use Filtration\Model\UserModel;
use Filtration\Model\WalletModel;


class TransferController extends \Filtration\Core\Controller 
{

    public function deposit($coin) 
	{
        //make sure they're logged in
        UserModel::authentication();
        
        //get the session user
        $user = UserModel::user();

        //market
        $deposits = TransferModel::transaction(strtolower($coin), 'deposits');
        
        //iniate the coin
        switch($coin){
            case 'btc':
                $maincoin = CoinsModel::btccoin();
            break;
            case 'ltc':
                $maincoin = CoinsModel::ltccoin();
            break;
        }
        


        //deposit
        $address = WalletModel::wallet($coin, $maincoin);

		$this->View->Render('transfer/deposit', 
                array
                (
                    'market'   => $coin, 
                    'deposits' => $deposits, 
                    'address'  => $address
                )
            );
    }


    public function withdraw($coin) 
    {
        //make sure they're logged in
        UserModel::authentication();
        
        //get the session user
        $user = UserModel::user();

        //market
        $withdraw = TransferModel::transaction(strtolower($coin), 'withdraw');
        
        //get their payees
        $payees = TransferModel::payees(strtolower($coin));

        $this->View->Render('transfer/withdraw', array('market' => $coin, 'withdraw' => $withdraw, 'payees' => $payees, 'user' => $user));
    }

    public function payees($coin = null) 
    {

        //make sure they're logged in
        UserModel::authentication();
        
        //get the session user
        $user = UserModel::user();
        
        //get their payees
        $payees = TransferModel::payees(strtolower($coin));

        $this->View->Render('transfer/payee', array('payees' => $payees));

    }
    
    public function add_payee()
    {
        //make sure they're logged in
        UserModel::authentication();
        
        //get the session user
        $user = UserModel::user();
        
        $payees = $this->model->payees($username, '');
    }


    /*
     * Edit this method, rewrite and clean it
     */
    public function payment() 
    {
        $market = isset($_POST['ok_txn_currency']) ? strtolower($_POST['ok_txn_currency']) : '';
        $amount = isset($_POST['ok_txn_net']) ? $_POST['ok_txn_net'] : '';
        $username = isset($_POST['ok_item_1_custom_1_value']) ? $_POST['ok_item_1_custom_1_value'] : '';
        $status = isset($_POST['ok_txn_status']) ? $_POST['ok_txn_status'] : '';
        $txid = isset($_POST['ok_txn_id']) ? $_POST['ok_txn_id'] : '';
        $firstname = isset($_POST['ok_payer_first_name']) ? $_POST['ok_payer_first_name'] : '';
        $lastname = isset($_POST['ok_payer_last_name']) ? $_POST['ok_payer_last_name'] : '';
        $email = isset($_POST['ok_payer_email']) ? $_POST['ok_payer_email'] : '';
        $country = isset($_POST['ok_payer_country']) ? $_POST['ok_payer_country'] : '';
        $state = isset($_POST['ok_payer_state']) ? $_POST['ok_payer_state'] : '';
        $street = isset($_POST['ok_payer_street']) ? $_POST['ok_payer_street'] : '';


        // Read the post from OKPAY and add 'ok_verify' 
        $req = 'ok_verify=true';
        foreach ($_POST as $key => $value) {
            $value = SURLencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        // Post back to OKPAY to validate 
        $header .= "POST /ipn-verify.html HTTP/1.0\r\n";
        $header .= "Host: www.okpay.com\r\n";
        $header .= "Content-Type: application/x-www-form-SURLencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        $fp = fsockopen('www.okpay.com', 80, $errno, $errstr, 30);

        if (!$fp) {
            exit('Error postback');
        }
        fputs($fp, $header . $req);
        while (!feof($fp))
            $res = fgets($fp, 1024);
        fclose($fp);
        if ($res != "VERIFIED") {
            exit('Not verified');
        }

        if ($_POST['ok_txn_status'] !== 'completed')
            exit('Invalid ok_txn_status');


        $checktx = $this->db->prepare("SELECT * FROM transactions WHERE txid=? LIMIT 1");
        $checktx->execute(array($txid));
        $result = $checktx->fetch();
        //if(!$result):
        if (isset($market) && isset($amount)):
            $date = date("y-m-d h:i:s");
            //insert into transactions and update balance
            $transaction = $this->db->prepare("INSERT INTO transactions(market,amount,
				username,txid,transaction,status,date,firstname,lastname,email,country,
				state,street) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $transaction->execute(array($market, $amount, $username, $txid, 'deposit', '1',
                $date, $firstname, $lastname, $email, $country, $state, $street));
            if ($transaction):
                //get the user and their balance
                $getuserbalance = $this->db->prepare("SELECT * FROM user WHERE username=?");
                $getuserbalance->execute(array($username));
                $userbalance = $getuserbalance->fetch();
                //this is their new balance
                $newbalance = $amount + $userbalance->{$market};
                $updateuser = $this->db->prepare("UPDATE user SET " . htmlentities($market) . "=? WHERE username=?");
                $updateuser->execute(array($newbalance, $username));
            endif;
        endif;
        //endif;
    }

}

?>